<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Models\UserChat;
use Illuminate\Http\Request;

class BotManController extends Controller
{
    public function handle()
    {
        $botman = app('botman');
        $botman->hears('{message}', function (BotMan $botman, $message) {
            if (strtolower($message) == 'hi' || strtolower($message) == 'hello') {
                $botman->startConversation(new OnboardingConversation());
            } else {
                $botman->reply("Start the conversation by saying Hi.");
            }
        });
        $botman->listen();
    }
}

class OnboardingConversation extends Conversation
{
    protected $name;
    protected $phoneNumber;
    protected $email;
    protected $address;

    public function askName()
    {
        
        
        $this->ask('Hello! What is your name?', function (Answer $answer) {
            $this->name = $answer->getText();
            $this->say("Nice to meet you " . $this->name);
            $this->askPhoneNumber();
        });
    }
    public function askAddress(){
        $this->ask("What is Your Address?",function (Answer $answer){
             $this->address= $answer->getText();
             $this->say("Your Address is".$this->address);
             $this->say("We will contact you soon");   
             UserChat::create([
                'name' => $this->name,
                'phone_number' => $this->phoneNumber,
                'email' => $this->email,
            ]);   
        });
    }

    public function askPhoneNumber()
    {
        $this->ask('Tell us your phone number:', function (Answer $answer) {
            $phoneNumber = $answer->getText();

            // Validate phone number: only numbers and exactly 10 digits
            if (!preg_match('/^\d{10}$/', $phoneNumber)) {
                $this->say("Invalid phone number format. Please enter a 10-digit phone number.");
                return $this->askPhoneNumber(); // Re-ask for the phone number
            }

            $this->phoneNumber = $phoneNumber;
            $this->say("Your phone number is " . $this->phoneNumber);
            $this->askEmail();
        });
    }

    public function askEmail()
    {
        $this->ask('Can you tell us your email?', function (Answer $answer) {
            $this->email = $answer->getText();
            
            // Validate Email
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->say("Your email is " . $this->email);
                $this->confirmEmail();
            } else {
                $this->say("Invalid email format. Please enter a valid email.");
                $this->askEmail(); // Re-ask for the email
            }
        });
    }

    public function confirmEmail()
    {
        $this->ask('Confirm your Email (Y/N):', function (Answer $answer) {
            $confirmEmail = $answer->getText();
            if (strtolower($confirmEmail) == 'y' || strtolower($confirmEmail) == 'yes') {
                $this->say(" Thank you!");


                // Save the details to the database
            
            } elseif (strtolower($confirmEmail) == 'n' || strtolower($confirmEmail) == 'no') {
                $this->say("Please confirm your email.");
                $this->askEmail(); // Re-ask for the email
            } else {
                $this->say("Please answer with Y or N.");
                $this->confirmEmail(); // Re-ask for confirmation
            }
            $this->askAddress();
        });
    }
    
  
        

    public function run()
    {
        $this->askName();
    }
}

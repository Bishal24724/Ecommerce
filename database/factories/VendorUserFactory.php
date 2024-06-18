<?php

namespace Database\Factories;

use App\Models\VendorUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorUser>
 */
class VendorUserFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            
            'name' => $this->faker->name(),
           
            'email' => $this->faker->unique()->safeEmail,
           
            'password' => bcrypt('password'), // Default password
            
        ];
    }
}

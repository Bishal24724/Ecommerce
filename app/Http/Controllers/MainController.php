<?php

namespace App\Http\Controllers;




use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Enquiry;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(){
        $allproducts = Product::all();
        $newArrival = Product::where('type', 'new-arrivals')->get();
        $bestSellers = Product::where('type', 'Best Sellers')->get();
        $hotsale = Product::where('type', 'sale')->get();
        return view('index', compact('allproducts', 'hotsale', 'newArrival', 'bestSellers'));
    }

    public function cart(){
        $cartItems = Product::join('carts', 'carts.productId', 'products.id')
            ->select('products.title', 'products.quantity as pQuantity', 'products.price', 'products.picture', 'carts.*')
            ->where('carts.customerId', session()->get('id'))
            ->get();
        return view('cart', compact('cartItems'));
    }

    public function checkout(Request $data){
        if (Session::has('id')) {
            $data->validate([
                'bill' => 'required|numeric',
                'address' => 'required|string|max:255',
                'fullname' => 'required|string|max:255',
                'phone' => 'required|string|max:10',
            ]);
         
            $order = new Order();
            $order->status = 'Pending';
            $order->customerId = session()->get('id');
            $order->bill = $data->input('bill');
            $order->address = $data->input('address');
            $order->fullname = $data->input('fullname');
            $order->phone = $data->input('phone');
            $carts = Cart::where('customerId', session()->get('id'))->get();
           foreach($carts as $cart){
                   $product= Product::find($cart->productId);
                  $order->vendor_id=$product->vid;
           }
        

            if ($order->save()) {
               
                foreach ($carts as $item) {
                    $product = Product::find($item->productId); 
                    $orderItem = new OrderItem();
                    $orderItem->productId = $item->productId;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->price = $product->price; // Make sure to set the price correctly
                    $orderItem->orderId = $order->id;
                    
                   
                    $orderItem->save();
                    $item->delete();
                }
                return redirect()->back()->with('success', 'Your order has been placed successfully');
            }
        } else {
            return redirect('login')->with('error', 'Please Login first');
        }
    }

    public function shop(){
        $allproducts = Product::orderBy('id', 'desc')->simplePaginate(5);

        return view('shop',compact('allproducts'));
    }

    public function profile(){
        if (session()->has('id')) {
            $user = User::find(session()->get('id'));
            return view('profile', compact('user'));
        }
        return redirect('login');
    }

    public function myOrders(){
        if (session()->has('id')) {
            $orders = Order::where('customerId', session()->get('id'))->get();
            $orders->each(function ($order) {
                $order->vat = 0.13 * $order->bill;
            });
            $orders->each(function ($order) {
                $order->total = $order->bill + $order->vat ;
            });
   
        
            $items = DB::table('products')
                ->join('order_items', 'order_items.productId', 'products.id')
                ->select('products.title', 'products.picture',  'order_items.*')
                ->get();
                     
              
                   
                   
                
            return view('orders', compact('orders', 'items'));
        }
        return redirect('login');
    }

    public function singleProduct($id){
        $product = Product::find($id);
        $vendor = DB::table('products')
        ->join('vendor_users', 'products.vid', '=', 'vendor_users.id')
        ->select('vendor_users.name', 'vendor_users.address')
        ->where('products.id', '=', $id)
        ->first(); // Use first() instead of get() to directly get the first result

    // Check if vendor data is available
    if ($vendor) {
        $vendor_name = $vendor->name;
        $vendor_address = $vendor->address;
    } else {
        // Handle the case where no vendor was found, set default values or throw an error
        $vendor_name = 'Vendor not found';
        $vendor_address = 'Address not available';
    }
        
        return view('singleProduct', compact('product', 'vendor_name','vendor_address'));
      
        //return view('singleProduct', compact('product'));
    }

    public function deleteCartItem($id){
        $item = Cart::find($id);
        $item->delete();
        return redirect()->back()->with('success', 'One item has been deleted from cart');
    }

    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    public function logout(){
        Session::forget('id');
        Session::forget('type');
        return redirect('login')->with('success', 'Logged out successfully');
    }

    public function registerUser(Request $data){
        $data->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($data->hasFile('file')) {
            $file = $data->file('file');
            $newUser = new User();
            $newUser->fullname = $data->input('fullname');
            $newUser->email = $data->input('email');
            $newUser->password = Hash::make($data->input('password')); // Hash the password
            $newUser->picture = $file->getClientOriginalName();
            $file->move('uploads/profiles/', $newUser->picture);
            $newUser->type = "Customer";

            if ($newUser->save()) {
                return redirect('login')->with('success', 'New Account Created Successfully');
            } else {
                return back()->with('error', 'Failed to create account');
            }
        } else {
            return back()->with('error', 'No file uploaded');
        }
    }

    public function loginUser(Request $data){
        $data->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $data->input('email'))->first();

        if ($user && Hash::check($data->input('password'), $user->password)) {
            if ($user->status == "Blocked") {
                return redirect('login')->with('error', 'You have been blocked. Please contact us.');
            }
            /*
            Session::put('id', $user->id); // user id is saved for further
            Session::put('type', $user->type); // user type is saved for further
            */
            session([
                'id' => $user->id,
                'type' => $user->type,
                'picture' => $user->picture 
            ]);
    

            if ($user->type == 'Customer') {
           
                return redirect('/'); 
            } 
            
            else {
             
                return redirect('login')->with('error', 'Invalid Credentials');
            }

        } else {
          
            return redirect('login')->with('error', 'Invalid Credentials');
        }

    }


    public function addToCart(Request $data){
        if (session()->has('id')) {
            $data->validate([
                'quantity' => 'required|integer',
                'id' => 'required|integer|exists:products,id'
            ]);

            $item = new Cart();
            $item->quantity = $data->input('quantity');
            $item->productId = $data->input('id');
            $item->customerId = session()->get('id');
            $item->save();

            return redirect('shop')->with('success', 'Item Added to Cart Successfully');
        } else {
            return redirect('login')->with('error', 'Please Login First');
        }
    }
    

    public function updateCart(Request $data){
        if (session()->has('id')) {
            $data->validate([
                'id' => 'required|integer|exists:carts,id',
                'quantity' => 'required|integer',
            ]);

            $item = Cart::find($data->input('id'));
            $item->quantity = $data->input('quantity');
            $item->save();

            return redirect()->back()->with('success', 'Number of Quantity updated successfully');
        } else {
            return redirect('login')->with('error', 'Please Login First');
        }
    }

    /*
    public function updateUser(Request $data){
        $data->validate([
            'fullname' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = User::find(session()->get('id'));
        $user->fullname = $data->input('fullname');
        $user->password = Hash::make($data->input('password'));

        if ($data->file('file') != null) {
            $user->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/profiles/', $user->picture);
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Your account is updated');
        }
    }
        */
        public function updateUser(Request $data){
            $data->validate([
                'fullname' => 'required|string|max:255',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
        
            $user = User::find(session()->get('id'));
            $user->fullname = $data->input('fullname');
        
            // Check if the password field is filled
            if ($data->filled('password')) {
                // Update password only if a new password is provided
                $data->validate([
                    'password' => 'string|min:8',
                ]);
                $user->password = Hash::make($data->input('password'));
            }
        
            // Update profile picture if a new one is uploaded
            if ($data->hasFile('file')) {
                $user->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/profiles/', $user->picture);
            }
        
            if ($user->save()) {
                return redirect()->back()->with('success', 'Your account is updated');
            }
        }
        
    public function contactUS(Request $data){
        $data->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'message'=>'required|string|max:255',
            ]);
            $contact = new Enquiry();
            $contact->fullname = $data->input('fullname');
            $contact->email = $data->input('email');
            $contact->message = $data->input('message');
            if ($contact->save()) {
                return redirect()->back()->with('message', 'Your message is sent successfully');
                }
                


    }
}

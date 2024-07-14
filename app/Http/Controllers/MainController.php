<?php

namespace App\Http\Controllers;




use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Enquiry;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Category;
Use App\Models\DeliveryAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(){
   
        $allproducts = Product::with(['sizes','type','brand','category'])->get(); 
        $rate=[];
        foreach($allproducts as $product){
            $rate=$product->price;
        }
        $newArrival= Type::where('tname','new-arrivals')->get();
        $bestSellers= Type::where('tname','Best Sellers')->get();
        $hotsale= Type::where('tname','Sale')->get();
      
   
        return view('index', compact('allproducts', 'hotsale', 'newArrival', 'bestSellers','rate'));
    }

/*
    public function cart(){
        $cartItems = Product::join('carts', 'carts.productId', 'products.id')
            ->select('products.title', 'products.quantity as pQuantity', 'products.price', 'products.picture', 'carts.*')
            ->where('carts.customerId', session()->get('id'))
            ->get();
        return view('cart', compact('cartItems'));
    }
        */
 public function cart()
{
    $cartItems = DB::table('carts')
        ->join('products', 'carts.productId', '=', 'products.id')
        ->join('product_sizes', 'carts.sizeId', '=', 'product_sizes.id')
        ->select('products.title', 'products.quantity as pQuantity', 'product_sizes.rate', 'products.picture', 'carts.*')
        ->where('carts.customerId', session()->get('id'))
        ->get();

    // Calculate total based on rate and quantity
    $total = 0;
    foreach ($cartItems as $item) {
        $total += ($item->rate * $item->quantity);
    }

    return view('cart', compact('cartItems', 'total'));
}

public function checkout(Request $data)
{
    if (Session::has('id')) {
        $data->validate([
            'bill' => 'required|numeric',
            'address' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'lat'=>'required',
            'lng'=>'required'
        ]);

        $order = new Order();
       
        $order->status = 'Pending';
        $order->customerId = session()->get('id');
        $order->bill = $data->input('bill');
        $order->address = $data->input('address');
        $order->fullname = $data->input('fullname');
        $order->phone = $data->input('phone');

        
     //add the long and latitude to delivery address table
     

        // Set vendor_id for the order
        $cartItems = Cart::where('customerId', session()->get('id'))->get();
        if ($cartItems->isNotEmpty()) {
            $firstProduct = Product::find($cartItems->first()->productId);
            $order->vendor_id = $firstProduct->vid;
        }

        if ($order->save()) {
            $deliveryAddress = new DeliveryAddress();
            $deliveryAddress->cId = session()->get('id');
            $deliveryAddress->longitude = $data->input('lng');
            $deliveryAddress->latitude = $data->input('lat');
            $deliveryAddress->oId = $order->id;
            $deliveryAddress->save();
            
            foreach ($cartItems as $item) {
                // Find the product size rate based on sizeId in the cart item
                $productSize = ProductSize::where('id', $item->sizeId)->first();

                $orderItem = new OrderItem();
                $orderItem->productId = $item->productId;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $productSize ? $productSize->rate : 0; // Fallback to 0 if productSize not found
                $orderItem->orderId = $order->id;


                $orderItem->save();

                // save deliveryaddress
                $deliveryAddress->save();
                $item->delete();
            }
            return redirect()->back()->with('success', 'Your order has been placed successfully');
        }
    } else {
        return redirect('login')->with('error', 'Please Login first');
    }
}


    public function shop(){
        $allproducts = Product::with(['sizes','type'])->orderBy('id', 'desc')->simplePaginate(5);
    $allbrand=Brand::all();
    $allcategory=Category::all();
    $alltype=Type::all();
        return view('shop',compact(['allproducts','allcategory','alltype','allbrand']));
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

    public function singleProduct($id) {
        // Fetch the product along with its sizes
        $product = Product::with('sizes')->find($id);
        
        // Fetch the vendor details
        $vendor = DB::table('products')
            ->join('vendor_users', 'products.vid', '=', 'vendor_users.id')
            ->select('vendor_users.name', 'vendor_users.address')
            ->where('products.id', '=', $id)
            ->first(); 
    
        // Check if vendor data is available
        if ($vendor) {
            $vendor_name = $vendor->name;
            $vendor_address = $vendor->address;
        } else {
            // Handle the case where no vendor was found, set default values or throw an error
            $vendor_name = 'Vendor not found';
            $vendor_address = 'Address not available';
        }
    
        // Pass the product, vendor name, and vendor address to the view
        return view('singleProduct', compact('product', 'vendor_name', 'vendor_address'));
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
                'id' => 'required|integer|exists:products,id',
                'size'=>'required|integer'
            ]);

            $item = new Cart();
            $item->quantity = $data->input('quantity');
            $item->productId = $data->input('id');
            $item->customerId = session()->get('id');
            $item->sizeId= $data->input('size');
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
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VendorUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//use App\Http\Controller\VendorController;

class AdminController extends Controller
{
    public function loginadmin(Request $data){
        $data->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::where('email', $data->input('email'))->first();

        if ($user && Hash::check($data->input('password'), $user->password)) {
         
            /*
            Session::put('id', $user->id); // user id is saved for further
            Session::put('type', $user->type); // user type is saved for further
            */
            session([
                'id' => $user->id,
                'type' => $user->type,
                'picture' => $user->picture 
            ]);
    

            if ($user->type == 'Admin') {
               
                return redirect('/admin');
            }
            
            else {
             
                return redirect()->back()->with('error', 'Invalid Credentials');
            }

        } else {
          
            return redirect()->back()->with('error', 'Invalid Credentials');
        }

    }
    public function index(){
        if(session()->get('type')=='Admin'){
            return view('Dashboard.index'); 
        }
        return redirect()->back();
    }

    public function profile(){
        if(session()->get('type')=='Admin'){
            $user = User::find(session()->get('id'));
            return view('Dashboard.profile', compact('user'));
        }
        return redirect()->back();
    }

    public function products() {
        if(session()->get('type') == 'Admin') {
        $vendor=VendorUser::get();

        
            $products = Product::join('vendor_users', 'products.vid', '=', 'vendor_users.id')
                ->select('products.*', 'vendor_users.name as vendor_name')
                ->get();
    
            return view('Dashboard.products', compact('products','vendor')); 
        }
        return redirect()->back();
    }
    

    public function customers(){
        if(session()->get('type')=='Admin'){
            $customers = User::where('type', 'Customer')->get();
            return view('Dashboard.customers', compact('customers')); 
        }
        return redirect()->back();
    }
/*
    public function deleteProduct($id){
        if(session()->get('type')=='Admin'){
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully');
        }
        return redirect()->back();
    }
        */

    public function changeUserStatus($status, $id){
        if(session()->get('type')=='Admin'){
            $user = User::find($id);
            $user->status = $status;
            $user->save();
            return redirect()->back()->with('success', 'User Status Updated Successfully');
        }
        return redirect()->back();
    }

    public function changeOrderStatus($status, $id){
        if(session()->get('type')=='Admin'){
            $order = Order::find($id);
            $order->status = $status;
            

            if($status=='Delivered'){
                
                $orderItems = OrderItem::where('orderId', $id)->get();
               foreach ($orderItems as $item) {
                // this will search for the product where product id is match with the productId exist in the orders_items.
                    $product = Product::find($item->productId);
    
                    if ($product) {
                        // this will decrease the quantity of available products from the products table whose orders  status has been completed.
                        $product->quantity -= $item->quantity;
                        $product->save();
                    }
                }
               
                
            }
            $order->save();
            return redirect()->back()->with('success', 'Order Status Updated Successfully');
        }
        return redirect()->back();
    }

    public function AddNewProduct(Request $data){
        if(session()->get('type')=='Admin'){
            $data->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'type' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
                'vendor'=>'required|integer'
            ]);

            $products = new Product();
            $products->title = $data->input('title');
            $products->price = $data->input('price');
            $products->type = $data->input('type');
            $products->quantity = $data->input('quantity');
            $products->category = $data->input('category');
            $products->description = $data->input('description');
            $products->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move('uploads/products/', $products->picture);
            $products->vid = $data->input('vendor');
            $products->save();

            return redirect()->back()->with('success', 'New Product Added Successfully');
        }
        return redirect()->back();
    }

    public function updateProduct(Request $data){
        if(session()->get('type')=='Admin'){
            $data->validate([
                'id' => 'required|integer',
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'type' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
                'vendor'=>'nullable|integer'
            ]);

            $products = Product::find($data->input('id'));
            $products->title = $data->input('title');
            $products->price = $data->input('price');
            $products->type = $data->input('type');
            $products->quantity = $data->input('quantity');
            $products->category = $data->input('category');
            $products->description = $data->input('description');
            if ($data->file('file') != null) {
                $products->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/products/', $products->picture);
            }
            if($data->input('vendor')!=null)
            {
            
                  $products->vid=$data->input('vendor');
            }
          

            $products->save();
            return redirect()->back()->with('success', 'Product Updated Successfully');
        }
        return redirect()->back();
    }

    public function orders(){
        if(session()->get('type')=='Admin'){
            $orderItems = DB::table('order_items')
                ->join('products', 'order_items.productId', 'products.id')
                ->select('products.title', 'products.picture', 'order_items.*')
                ->get();

            $orders = DB::table('users')
                ->join('orders', 'orders.customerId', 'users.id')
                ->select('orders.*', 'users.fullname', 'users.email', 'users.status as userStatus')
                ->get();

            return view('Dashboard.orders', compact('orders', 'orderItems')); 
        }
        return redirect()->back();
    }
}

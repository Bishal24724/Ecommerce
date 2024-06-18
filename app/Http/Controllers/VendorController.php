<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\VendorUser;
use App\Models\VendorProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Enquiry;
use App\Models\OrderItem;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function vendorlogout(){
        Session::forget('id');
        Session::forget('name');
        return redirect('vendorlogin')->with('success', 'Logged out successfully');
    }
    public function loginVendor(Request $data){
        $data->validate([
           
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $user = VendorUser::where('email', $data->input('email'))->first();

        if ($user && Hash::check($data->input('password'), $user->password)) {
           
          
            session([
                'id' => $user->id,
                'name' => $user->name,
              
            ]);
    
            return redirect('/vendor');
            } else {
                return redirect()->back()->with('message','invalid Credentials');
            }
        

    }
    public function index(){
       
            return view('Vendor.index'); 
        
        return redirect()->back();
    }
       public function products(){
    
        $products = Product::where('vid', Session::get('id'))->get();
        return view('Vendor.products',compact('products'));

       }
    /*

    public function AddProduct(Request $data){
      
            $data->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                
                'quantity' => 'required|integer',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $products = new VendorProduct();
            $products->title = $data->input('title');
            $products->price = $data->input('price');
           
            $products->quantity = $data->input('quantity');
            $products->picture = $data->file('file')->getClientOriginalName();
            $data->file('file')->move(public_path('uploads/vendorproducts'), $products->picture);
            $products->description = $data->input('description');
            $products->category = $data->input('category');
         
        
            $products->save();

            return redirect()->back()->with('success', 'New Product Added Successfully');
        }
        public function UpdateItem(Request $data){

                $data->validate([
                    'id' => 'required|integer',
                    'title' => 'required|string|max:255',
                    'price' => 'required|numeric',
                   
                    'quantity' => 'required|integer',
                    'category' => 'required|string|max:255',
                    'description' => 'required|string',
                    'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
                ]);
    
                $products = VendorProduct::find($data->input('id'));
                $products->title = $data->input('title');
                $products->price = $data->input('price');
              
                $products->quantity = $data->input('quantity');
                if ($data->file('file') != null) {
                    $products->picture = $data->file('file')->getClientOriginalName();
                    $data->file('file')->move('uploads/products/', $products->picture);
                }
                $products->description = $data->input('description');
                $products->category = $data->input('category');
                
              
    
                $products->save();
                return redirect()->back()->with('success', 'Product Updated Successfully');
            }

            public function deleteItem($id){
                
                    $product = VendorProduct::find($id);
                    $product->delete();
                    return redirect()->back()->with('success', 'Product Deleted Successfully');
                }
                    */
              
            
            public function vendorOrder(){
                if (session()->has('id')) {
                    $vendor_id = session()->get('id');
                    $orders = Order::where('vendor_id', $vendor_id)->get();
                    
                  
                   
                  /*
                    $orderItems = DB::table('order_items')
                    ->join('products', 'order_items.productId', '=', 'products.id')
                    ->select('products.title', 'products.picture', 'order_items.*')
                    ->where('products.vid', '=', $vendor_id)
                    ->get();
                    */
                    $orderItems = DB::table('order_items')
                    ->join('products', 'order_items.productId', '=', 'products.id')
                    ->select('products.title', 'products.picture', 'order_items.orderId', 'order_items.price', 'order_items.quantity')
                    ->where('products.vid', '=', $vendor_id)
                    ->get();

        
        return view('Vendor.vendorOrder', compact('orders', 'orderItems'));
                
              
  
           
                           
                           
                
                }
                return redirect('vendorlogin');
            }


            public function AddNewProduct(Request $data){
                if (session()->has('id')) {
                    $vendor_id = session()->get('id');
                    $data->validate([
                        'title' => 'required|string|max:255',
                        'price' => 'required|numeric',
                        'type' => 'required|string|max:255',
                        'quantity' => 'required|integer',
                        'category' => 'required|string|max:255',
                        'description' => 'required|string',
                        'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
                        
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
                    $products->vid = $vendor_id;
                    
                    $products->save();
        
                    return redirect()->back()->with('success', 'New Product Added Successfully');
                }
                return redirect()->back();
            }
            public function updateProduct(Request $data){
                if(session()->has('id')){
                    $data->validate([
                        'id' => 'required|integer',
                        'title' => 'required|string|max:255',
                        'price' => 'required|numeric',
                        'type' => 'required|string|max:255',
                        'quantity' => 'required|integer',
                        'category' => 'required|string|max:255',
                        'description' => 'required|string',
                        'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
                        
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
                
                  
        
                    $products->save();
                    return redirect()->back()->with('success', 'Product Updated Successfully');
                }
                return redirect()->back();
            }

            // delete products
            public function deleteProduct($id){
                if(session()->has('id')){                                                                                   
                    $products = Product::find($id);
                    $products->delete();
                }
            }
        }
   
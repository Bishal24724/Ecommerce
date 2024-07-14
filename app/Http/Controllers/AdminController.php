<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VendorUser;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Notification;
use App\Models\ProductSize;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;


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
            $totalcustomer=User::where('type','customer')->count('id');
            $totalorder=Order::where('status','Pending')->count();
            $totalproduct=Product::count();
            $totalvendor=VendorUser::count();
            $totalcategory=Category::count();
            $totalbrand=Brand::count();
            $totaltype=Type::count();

           



            return view('Dashboard.index',compact(['totalcustomer','totalorder','totalproduct','totalvendor','totalcategory','totalbrand','totaltype'])); 
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
            $vendor = VendorUser::get();
    
            $products = Product::join('vendor_users', 'products.vid', '=', 'vendor_users.id')
                ->with(['type','category','brand'])
                ->select('products.*', 'vendor_users.name as vendor_name')
                ->with('sizes')
                ->get();
    
            $types = Type::all();
            $categories = Category::all();
            $brands = Brand::all();
    
            return view('Dashboard.products', compact('products', 'vendor', 'types', 'categories', 'brands'));
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
    public function vendordetail(){
        if(session()->get('type')=='Admin'){
     $vendors= VendorUser::all();
            return view('Dashboard.vendordetails', compact('vendors')); 
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
                $order->delivered_at=now();
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
                ->join('delivery_addresses','delivery_addresses.oId','orders.id')
                ->select('orders.*', 'users.fullname', 'users.email', 'users.status as userStatus','delivery_addresses.longitude','delivery_addresses.latitude')
                ->get();

            return view('Dashboard.orders', compact('orders', 'orderItems')); 
        }
        return redirect()->back();
    }
    public function AddNewVendor(Request $data){
        if(session()->get('type')=='Admin'){      
            
            $data->validate([
                'name' => 'required|string',
                'email' => 'required|string|email|unique:vendor_users',
                'phone'=>'required|numeric|min:10|unique:vendor_users',
                'password' => 'required|min:6',
                  'address'=> 'required|string'


            ]);
            $vendor = new VendorUser();
            $vendor->name = $data->input('name');
            $vendor->email = $data->input('email');
            $vendor->phone = $data->input('phone');                                                                                                                                                                                 
            $vendor->password = bcrypt($data->input('password'));                       
             $vendor->address = $data->input('address');
             $vendor->save();                                                                                   
             return redirect()->back()->with('success', 'Vendor Added Successfully');


        }

        }
        public function UpdateVendor(Request $data){
             if(session()->get('type')=='Admin'){
                $vendor = VendorUser::find($data->input('id'));                                    
                $data->validate([
                       'name'=>'required|string',
                       'email'=>'required|string|email|unique:vendor_users,email,'.$vendor->id, 
                       'phone'=>'required|string|min:10|max:10|unique:vendor_users,email,'.$vendor->id,
                       'address'=>'required|string'   
                ]);
                $vendor->name = $data->input('name');
                $vendor->email= $data->input('email');
                $vendor->phone=$data->input('phone');
                $vendor->address=$data->input('address');
                $vendor->save();       
                return redirect()->back()->with('success','Vendor Updated Successfully');                                                                                                                                                                                                                                                                                                                                                                                      

             }
        }
        public function deleteVendor($id){
            $vendor=VendorUser::find($id);
            $vendor->delete();
            return redirect()->back()->with('success','Vendor has been delete successfully');
            }

            public function type(){
                if(session()->has('id')){
                    $type=Type::get();
                    return view('Dashboard/admintype',compact('type'));
        
                }
                return redirect('adminlogin');
            }
            public function brand(){
                if(session()->has('id')){
                    $brands=Brand::get();
                    return view('Dashboard/adminBrand',compact('brands'));
        
                }
                return redirect('adminlogin');
            }
            public function category(){
                if(session()->has('id')){
                    $category=Category::get();
                    return view('Dashboard/adminCategory',compact('category'));
        
                }
                return redirect('adminlogin');
            }

            public function UpdateType(Request $data){
                if(session()->has('id')){
                    $type=Type::find($data->input('id'));
                    $data->validate([                               
                        'name' => 'required|string'
                ]);
                $type->tname = $data->input('name');
                $type->save();
                return redirect()->back()->with('success','Type has been update Successfully');
                }
            }

            public function UpdateBrand(Request $data){
                if(session()->has('id')){
                    $brand=Brand::find($data->input('id'));
                    $data->validate([                               
                        'name' => 'required|string'
                ]);
                $brand->bname = $data->input('name');
                $brand->save();
                return redirect()->back()->with('success','Brand has been update Successfully');
                }
            }
            public function UpdateCategory(Request $data){
                if(session()->has('id')){
                    $category=Category::find($data->input('id'));
                    $data->validate([                               
                        'name' => 'required|string'
                ]);
                $category->cname = $data->input('name');
                $category->save();
                return redirect()->back()->with('success','Category has been update Successfully');
                }
            }
            
            public function deleteType($id){
                if (session()->has('id')) {
                    $type = Type::find($id);
                    $type->delete();
                    return redirect()->back()->with('success', 'Type Deleted Successfully');                     
                }
                return redirect('Adminlogin');
            }
            public function deleteCategory($id){
                if (session()->has('id')) {
                    $category = Category::find($id);
                    $category->delete();
                    return redirect()->back()->with('success', 'Category Deleted Successfully');                     
                }
                return redirect('Adminlogin');
            }
            public function deleteBrand($id){
                if (session()->has('id')) {
                    $brand = Brand::find($id);
                    $brand->delete();
                    return redirect()->back()->with('success', 'Brand Deleted Successfully');                     
                }
                return redirect('Adminlogin');
            }

            public function message(){
                if(session()->has('id')){
                    $notification=Notification::all();
                    $vendors=VendorUser::all();
                return view('Dashboard/notification',compact('notification','vendors'));
                }
            }

            public function addMessage(Request $data){
                if (session()->has('id')) {
                    $data->validate([
                       'title' => 'required|string',
                       'message' => 'required|string',
                    ]);
                    $notification= new Notification();
                    $emails= VendorUser::get('email');
                    $notification->title=$data->input('title');
                    $notification->message=$data->input('message');
                    
                    $notification->save();
                    foreach($emails as $recipient){
                        Mail::to($recipient)->send(new NotificationEmail($data->all()));
                     }
                    return redirect()->back()->with('success','New Message has been added successfully');
                

            }
        }

            public function updateMessage(Request $data){
                if (session()->has('id')) {
                    $notification=Notification::find($data->input('id'));
                    $data->validate([
                         'title'=>'required|string',
                         'message'=>'required|string'
                    ]);
                    $notification->title=$data->input('title');
                    $notification->message=$data->input('message');
                    $notification->save();
                    return redirect()->back()->with('success','Message has been updated successfully');
                
            }
               return view('adminlogin')->with('success','Please Login First');


        }
        public function deleteMessage($id){
if(session()->has('id')){
$notification = Notification::find($id);
$notification->delete();
return redirect()->back()->with('success','Message has been deleted Successfully');
}
        }

    }


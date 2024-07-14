<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\VendorUser;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\Brand;
use App\Models\Type;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class VendorController extends Controller
{
  

    public function edit(string $id){
        
        if (session()->has('id')) {
            $product = Product::where('id', $id)->first();
            return view('Vendor/editProduct', ['product' => $product]);
        } else {
            return redirect('vendorlogin')->with('error','please login!!');
        }
    }
    
    public function vproductUpdate(Request $data, string $id){
        if (session()->has('id')) {     
            $data->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'type' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'category' => 'required|string|max:255',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $product = Product::where('id', $id)->first();
            $product->title = $data->input('title');
            $product->price = $data->input('price');
            $product->type = $data->input('type');
            $product->quantity = $data->input('quantity');
            $product->category = $data->input('category');
            $product->description = $data->input('description');

            if ($data->file('file') != null) {
                $product->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/products/', $product->picture);
            }

            $product->save();
            return redirect()->back()->with('success', 'Product Updated Successfully');
        } else {
            return redirect('vendorlogin')->with('error','please login!!');
        }                                           
    }
    
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

      public function SingleProduct(string $id){
        if(session()->has('id')){
            $product = Product::find($id);
            
            $notifications=Notification::latest()->take(3)->get();
            return view('Vendor.singleproduct', compact('product','notifications'));
        }
       
      }

    public function index(){
        if (session()->has('id')) {
           $totalproduct= Product::where('vid',Session::get('id'))->count();
           $totalorder= Order::where('vendor_id',Session::get('id'))->count();
           $totalcategory=Category::count();
           $totalcustomer = Order::where('vendor_id', Session::get('id'))
                                  ->whereIn('status', ['Delivered', 'Paid'])
                                ->count('customerId');

           $totalrevenue= Order::where('vendor_id',Session::get('id'))
                                ->whereIn('status',['Delivered','Paid'])
                                 ->sum('bill');

          $totalpending= Order::where('vendor_id',Session::get('id'))
                         ->where('status','Pending')
                                  ->count();

           $totalProduct=Product::where('vid',Session::get('id'))
                         ->count();
                
         $notifications=Notification::latest()->take(3)->get();
         $notification=Notification::all();
                          
          
                         
           $totalbrand=Brand::count();
           $totaltype=Type::count();
           
           // $totalCustomer=User::where('type','customer')->count()->get();


            return view('Vendor.index',compact('totalproduct','totalorder','totalcategory','notifications','notification','totalbrand','totaltype','totalcustomer','totalrevenue','totalpending')); 
        }
        return redirect()->back();
    }

    public function products(){
        $products = Product::where('vid', Session::get('id'))->with(['sizes','type','brand','type'])->get();
        $categories=Category::all();
        $brands=Brand::all();
        $types=Type::all();
        $notifications=Notification::latest()->take(3)->get();
        return view('Vendor.products', compact('products','categories','brands','types','notifications'));
    }
    public function brands(){
        if(session()->has('id')){
            $brands=Brand::all();
            $notifications=Notification::latest()->take(3)->get();
            return view('Vendor.brand',compact('brands','notifications'));

        }
        return redirect('vendorlogin');
    }

    public function AddNewBrand(Request $data){
        if(session()->has('id')){
            $data->validate([                               
                'name' => 'required|string'

        
        ]);
        $brand = new Brand();
        $brand->bname = $data->input('name');
        $brand->save();
        return redirect()->back()->with('message','Brand Added Successfully');
        }
        return redirect('vendorlogin');
    }
    public function AddNewCategory(Request $data){
        if(session()->has('id')){
            $data->validate([                               
                'name' => 'required|string'

        
        ]);
        $category = new Category();
        $category->cname = $data->input('name');
        $category->save();
        return redirect()->back()->with('message','Category Added Successfully');
        }
        return redirect('vendorlogin');
    }
    public function AddNewType(Request $data){
        if(session()->has('id')){
            $data->validate([                               
                'name' => 'required|string'
        ]);
        $type = new Type();
        $type->tname = $data->input('name');
        $type->save();
        return redirect()->back()->with('message','Type Added Successfully');
        }
        return redirect('vendorlogin');
    }
    

    
    public function category(){
        if(session()->has('id')){
            $category=Category::get();
            $notifications=Notification::latest()->take(3)->get();

            return view('Vendor.category',compact('category','notifications'));

        }
        return redirect('vendorlogin');
    }
    public function type(){
        if(session()->has('id')){
            $type=Type::get();
            $notifications=Notification::latest()->take(3)->get();

            return view('Vendor/type',compact('type','notifications'));

        }
        return redirect('vendorlogin');
    }
    public function deleteType($id){
        if (session()->has('id')) {
            $type = Type::find($id);
            $type->delete();
            return redirect()->back()->with('message', 'Type Deleted Successfully');                     
        }
        return redirect('vendorlogin');
    }
    public function deleteBrand($id){
        if (session()->has('id')) {
            $brand = Brand::find($id);
            $brand->delete();
            return redirect()->back()->with('success', 'Brand Deleted Successfully');                     
        }
        return redirect('vendorlogin');
    }
    public function deleteCategory($id){
        if (session()->has('id')) {
            $category = Category::find($id);
            $category->delete();
            return redirect()->back()->with('success', 'Category Deleted Successfully');                     
        }
        return redirect('vendorlogin');
    }

    public function vendorOrder(){
        if (session()->has('id')) {
            $vendor_id = session()->get('id');
            $orders = Order::where('vendor_id', $vendor_id)->get();
            $orderItems = DB::table('order_items')
                ->join('products', 'order_items.productId', '=', 'products.id')
                ->select('products.title', 'products.picture', 'order_items.orderId', 'order_items.price', 'order_items.quantity')
                ->where('products.vid', '=', $vendor_id)
                ->get();
            $notifications=Notification::latest()->take(3)->get();

            return view('Vendor.vendorOrder', compact('orders', 'orderItems','notifications'));
        }
        return redirect('vendorlogin');
    }

    public function AddNewProduct(Request $request)
    {
        if (session()->has('id')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'type' => 'required|integer',
                'brand' => 'required|integer',
                'quantity' => 'required|integer',
                'category' => 'required|integer',
                'description' => 'required|string',
                'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
                'sizes' => 'array',
                'rates' => 'array'
            ]);

            $product = new Product();
            $product->title = $request->input('title');
            $product->price = $request->input('price');
            $product->tid = $request->input('type');
            $product->bid = $request->input('brand');
            $product->cid = $request->input('category');
            $product->quantity = $request->input('quantity');
            $product->description = $request->input('description');
            $product->picture = $request->file('file')->getClientOriginalName();
            $request->file('file')->move('uploads/products/', $product->picture);
            $product->vid = session()->get('id');
            $product->save();

            if ($request->has('sizes') && $request->has('rates')) {
                foreach ($request->input('sizes') as $index => $size) {
                    $rate = $request->input('rates')[$index];
                    $productSize = new ProductSize();
                    $productSize->product_id = $product->id;
                    $productSize->size = $size;
                    $productSize->rate = $rate;
                    $productSize->save();
                }
            }

            return redirect()->back()->with('success', 'New Product Added Successfully');
        }
        return redirect('vendorlogin');
    }

    public function UpdateProduct(Request $data) {
        if (session()->has('id')) {
            $data->validate([
                'id' => 'required|integer',
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'type' => 'required|string|max:255',
                'brand'=> 'required|string|max:255',
                'quantity' => 'required|integer',
                'category' => 'required|integer',
                'description' => 'required|string',
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
                'sizes' => 'array',
                'rates' => 'array'
            ]);

            $product = Product::find($data->input('id'));
            $product->title = $data->input('title');
            $product->price = $data->input('price');
            $product->tid = $data->input('type');
            $product->bid= $data->input('brand');
            $product->quantity = $data->input('quantity');
            $product->cid = $data->input('category'); 
            $product->description = $data->input('description');
            if ($data->file('file') != null) {
                $product->picture = $data->file('file')->getClientOriginalName();
                $data->file('file')->move('uploads/products/', $product->picture);
            }

            $product->save();

            ProductSize::where('product_id', $product->id)->delete();

            if ($data->has('sizes') && $data->has('rates')) {
                foreach ($data->input('sizes') as $index => $size) {
                    $rate = $data->input('rates')[$index];
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $size,
                        'rate' => $rate,
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Product Updated Successfully');
        }
        return redirect()->back();
    }

    public function deleteProduct($id){
        if (session()->has('id')) {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully');                     
        }
        return redirect('vendorlogin');
    }
}

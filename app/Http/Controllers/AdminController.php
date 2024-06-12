<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
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

    public function products(){
        if(session()->get('type')=='Admin'){
            $products = Product::all();
            return view('Dashboard.products', compact('products')); 
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

    public function deleteProduct($id){
        if(session()->get('type')=='Admin'){
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('success', 'Product Deleted Successfully');
        }
        return redirect()->back();
    }

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
                'file' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048'
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
                'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
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

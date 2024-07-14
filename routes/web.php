<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Route;



//vendor route
Route::view('/vendorlogin', 'Vendor.vendorlogin');
Route::post('/loginVendor',[VendorController::class,'loginVendor']);
//Route::post('/vendorlogin', [VendorController::class, 'vendorlogin']);
Route::get('/vendor',[VendorController::class, 'index']);
Route::get('/vendorproducts',[VendorController::class, 'products']);
Route::get('/deleteItem/{id}',[VendorController::class, 'deleteItem']);
Route::post('/AddProduct',[VendorController::class, 'AddProduct']);
Route::post('/UpdateItem',[VendorController::class, 'UpdateItem']);
Route::get('/vendorOrder',[VendorController::class,'vendorOrder']);
Route::get('/vendorlogout', [VendorController::class, 'vendorlogout'])->name('vendorlogout');
Route::get('/vendorproducts',[VendorController::class,'products'])->name('Products');
Route::get('/vendorbrand', [VendorController::class, 'brands'])->name('vendorbrand');
Route::get('/vendorcategory', [VendorController::class, 'category'])->name('vendorcategory');
Route::get('/vendortype', [VendorController::class, 'type'])->name('vendortype');
Route::post('/AddNewBrand',[VendorController::class, 'AddNewBrand']);
Route::post('/AddNewCategory',[VendorController::class, 'AddNewCategory']);
Route::post('/AddNewType',[VendorController::class, 'AddNewType']);
Route::post('/UpdateBrand',[VendorController::class, 'UpdateBrand']);
Route::post('/UpdateCategory',[VendorController::class, 'UpdateCategory']);
Route::post('/UpdateType',[VendorController::class, 'UpdateType']);
Route::get('/deleteType/{id}',[VendorController::class, 'deleteType']);




Route::get('/deleteProduct/{id}',[VendorController::class, 'deleteProduct']);
Route::post('/AddNewProduct',[VendorController::class, 'AddNewProduct']);
Route::post('/UpdateProduct',[VendorController::class, 'UpdateProduct']);
Route::get('/editproduct/{id}',[VendorController::class, 'edit']);
Route::post('/vproductUpdate/{id}',[VendorController::class,'vproductUpdate']);
Route::get('/product/{id}', [VendorController::class,'SingleProduct'])->name('products.view');






//Admin Routes
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/adminProducts',[AdminController::class, 'products']);
/*
Route::get('/deleteProduct/{id}',[AdminController::class, 'deleteProduct']);
Route::post('/AddNewProduct',[AdminController::class, 'AddNewProduct']);
Route::post('/UpdateProduct',[AdminController::class, 'UpdateProduct']);
*/
Route::get('/adminProfile',[AdminController::class, 'profile']);
Route::get('/ourCustomers',[AdminController::class, 'Customers']);
Route::get('/changeUserStatus/{status}/{id}',[AdminController::class, 'changeUserStatus']);
Route::get('/changeOrderStatus/{status}/{id}',[AdminController::class, 'changeOrderStatus']);
Route::get('/ourOrders',[AdminController::class, 'Orders']);
Route::get('/vendordetails',[AdminController::class, 'vendorDetail']);
Route::post('/AddNewVendor',[AdminController::class, 'AddNewVendor']);
Route::post('/UpdateVendor',[AdminController::class, 'UpdateVendor']);
Route::get('/deleteVendor/{id}',[AdminController::class,'deleteVendor']);
Route::post('/UpdateAType',[AdminController::class, 'UpdateType']);
Route::post('/UpdateABrand',[AdminController::class, 'UpdateBrand']);
Route::post('/UpdateACategory',[AdminController::class, 'UpdateCategory']);
Route::get('/deleteAType/{id}',[AdminController::class, 'deleteType']);
Route::get('/deleteABrand/{id}',[AdminController::class, 'deleteBrand']);
Route::get('/deleteACategory/{id}',[AdminController::class, 'deleteCategory']);



Route::view('/adminlogin', 'Dashboard.adminlogin');
Route::post('/loginadmin',[AdminController::class,'loginadmin']);
Route::get('/admintype', [AdminController::class, 'type'])->name('admintype');
Route::get('/admincategory', [AdminController::class, 'category'])->name('adminCategory');
Route::get('/adminbrand', [AdminController::class, 'brand'])->name('adminBrand');

Route::get('/message',[AdminController::class,'message'])->name('message');
Route::post('/AddNewMessage',[AdminController::class,'addMessage']);
Route::post('/updateMessage',[AdminController::class,'updateMessage']);
Route::get('/deleteMessage/{id}',[AdminController::class,'deleteMessage']);



 






//customer Routes
Route::get('/',[MainController::class,'index']);
Route::get('/cart',[MainController::class,'cart']);
Route::get('/shop',[MainController::class,'shop']);
Route::get('/single/{id}',[MainController::class,'singleProduct']);
Route::get('/checkout',[MainController::class,'checkout']);
Route::get('/register',[MainController::class,'register']);
Route::post('/registerUser',[MainController::class,'registerUser']);
Route::post('/loginUser',[MainController::class,'loginUser']);
Route::get('/login',[MainController::class,'login']);
Route::get('/profile',[MainController::class,'profile']);
Route::get('/logout', [MainController::class, 'logout'])->name('logout');
Route::post('/addToCart',[MainController::class,'addToCart']);
Route::post('/updateCart',[MainController::class,'updateCart']);
Route::post('/updateUser',[MainController::class,'updateUser']);
Route::get('/deleteCartItem/{id}',[MainController::class,'deleteCartItem']);
Route::get('/myOrders',[MainController::class,'myOrders']);
Route::post('/contactUs',[MainController::class, 'contactUs']);



Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle'])->name('botman');
Route::get('/chat', function () {
    return view('chat'); //blade files
});


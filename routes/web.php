<?php
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;



//Admin Routes
Route::get('/admin',[AdminController::class, 'index']);
Route::get('/adminProducts',[AdminController::class, 'products']);
Route::get('/deleteProduct/{id}',[AdminController::class, 'deleteProduct']);
Route::post('/AddNewProduct',[AdminController::class, 'AddNewProduct']);
Route::post('/UpdateProduct',[AdminController::class, 'UpdateProduct']);
Route::get('/adminProfile',[AdminController::class, 'profile']);
Route::get('/ourCustomers',[AdminController::class, 'Customers']);
Route::get('/changeUserStatus/{status}/{id}',[AdminController::class, 'changeUserStatus']);
Route::get('/changeOrderStatus/{status}/{id}',[AdminController::class, 'changeOrderStatus']);
Route::get('/ourOrders',[AdminController::class, 'Orders']);





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
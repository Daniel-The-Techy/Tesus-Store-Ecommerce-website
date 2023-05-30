<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishlistController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
*/
Route::post('/addToCart', [CartController::class, 'InsertCart']);
Route::post('/Register', [CustomerController::class, 'store']);
Route::post('/CustomerLogin', [CustomerController::class, 'Login']);
Route::get('/Products', [ProductController::class, 'index']);
Route::get('/Category', [ProductController::class, 'Category']);
Route::get('/GuestCarts', [CartController::class,'index']);
Route::get('/Category/{Product}', [ProductController::class, 'getCategory']);
Route::get('deleteCart/{id}', [CartController::class, 'deleteCart']);
Route::Post('/updateQuantity/{id}', [CartController::class, 'increaseQuantity']);
Route::get('Search/{name}', [ProductController::class, 'show']);
Route::get('Product/{Product:slug}', [ProductController::class, 'getProductBySlug']);
Route::post('/customer/Create', [CustomerController::class, 'store']);
Route::post('/checkOut', [CustomerController::class, 'CustomerCheckOut']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return Auth()->user();
//});
//Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'index']);

Route::group(['middleware'=> ['auth:sanctum']], function() {
   Route::get('/user',[UserController::class,'index']);
   Route::Post('Wishlist/Create', [WishlistController::class, 'store']);
   Route::get('/Wishlist/Show', [WishlistController::class, 'getProduct']);
   Route::get('/Carts', [UserController::class, 'getAllCart']);
   Route::delete('/wishlistDelete/{id}', [WishlistController::class,'deleteWishlist']);
   Route::put('/updatePassword', [CustomerController::class, 'updatePassword']);
   Route::post('/updateCustomer', [CustomerController::class, 'updateUser']);
   Route::get('/customer' , [CustomerController::class,'index']);
   Route::get('/customerLogout', [CustomerController::class, 'Logout']);
   Route::post('/updateCustomerAddress', [CustomerController::class,  'updateAddress']);
   Route::post('/OrderDetails', [CustomerController::class, 'CustomerCheckOut']);
   Route::post('/order', [CustomerController::class, 'customerOrder']);
  
});

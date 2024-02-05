<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PromocodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Aut JWT
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'clientProfile']);
    Route::post('/update-profile',[AuthController::class, 'updateProfile']);
});

//Catogory
Route::get('category',[CategoryController::class,'allCategory']);
Route::get('category/{id}/products',[ProductController::class,'getProductByCategory']);


//Address
Route::get('address',[AddressController::class,'getAddress']);
Route::post('address',[AddressController::class,'CreateAddress']);
Route::post('address_update',[AddressController::class,'updateAddress']);

//Product
Route::get('/products',[ProductController::class,'allProduct']);
Route::get('/product/{id}',[ProductController::class,'getProduct']);

//Review
Route::get('/reviews',[ReviewController::class,'getReview']);
Route::post('/reviews/add',[ReviewController::class,'storeReview']);

//favourite
Route::get('/favourites',[FavouriteController::class,'getFavourite']);
Route::post('/favourites/add',[FavouriteController::class,'createFavourite']);

//Cart
Route::get('/cart',[CartController::class,'getCart']);


//CartItem
Route::post('/cartItem/add',[CartItemController::class,'createCartItem']);
Route::post('/cartItem/edit',[CartItemController::class,'editCartItem']);
Route::post('/cartItem/delete',[CartItemController::class,'deleteCartItem']);

//order
Route::post('/order/add',[OrderController::class,'createOrder']);
Route::post('/order/promo',[OrderController::class,'allPromo']);
Route::post('/order/delete',[OrderController::class,'delete']);




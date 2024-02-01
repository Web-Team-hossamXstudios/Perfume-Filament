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
Route::get('category',[CategoryController::class,'index']);

//Address
Route::get('address',[AddressController::class,'getAddress']);
Route::post('address',[AddressController::class,'storeAddress']);
Route::post('address_update/{id}',[AddressController::class,'updateAddress']);

//Product
Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);

//Review
Route::get('/reviews/{id}',[ReviewController::class,'index']);
Route::post('/reviews',[ReviewController::class,'store']);

//favourite
Route::get('/favourites',[FavouriteController::class,'index']);
Route::post('/favourites',[FavouriteController::class,'store']);

//Cart
Route::get('/cart',[CartController::class,'getCart']);


//CartItem
Route::get('/cartItem',[CartItemController::class,'createCartItem']);
Route::post('/EditCartItem/{id}',[CartItemController::class,'EditCartItem']);
Route::post('/DeleteCartItem/{id}',[CartItemController::class,'DeleteCartItem']);

//order
Route::post('/order',[OrderController::class,'store']);


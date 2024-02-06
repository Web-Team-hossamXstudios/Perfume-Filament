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
use App\Http\Controllers\TowFactor;

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
Route::post('/forget_password', [TowFactor::class, 'forgetPassword']);
Route::post('/update/password', [TowFactor::class, 'UpdatePasswordByOtp']);
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'clientProfile']);
    Route::post('/update-profile',[AuthController::class, 'updateProfile']);
});

//Catogory
Route::get('/category',[CategoryController::class,'allCategory']);

//Address
Route::get('address',[AddressController::class,'getAddress']);
Route::post('address/create',[AddressController::class,'CreateAddress']);
Route::post('address_update/{id}',[AddressController::class,'updateAddress']);

//Product
Route::get('/products',[ProductController::class,'allProduct']);
Route::get('/products/featured',[ProductController::class,'ProductWithFeature']);
Route::get('/product/{id}',[ProductController::class,'getProduct']);
Route::get('/products/category/{id}',[ProductController::class,'getProductByCategory']);


//Review
Route::get('/reviews',[ReviewController::class,'getReviewByClient']);
Route::post('/reviews/add',[ReviewController::class,'storeReview']);
Route::get('/reviews/product/{id}',[ReviewController::class,'getReviewByProduct']);


//favourite
Route::get('/favourites',[FavouriteController::class,'getFavourite']);
Route::post('/favourites/add',[FavouriteController::class,'createFavourite']);
Route::post('/favourites/delete',[FavouriteController::class,'deleteFavourite']);


//Cart
Route::get('/cart',[CartController::class,'getCart']);


//CartItem
Route::post('/cartItem/add',[CartItemController::class,'createCartItem']);
Route::post('/cartItem/edit',[CartItemController::class,'editCartItem']);
Route::post('/cartItem/delete',[CartItemController::class,'deleteCartItem']);

//order
Route::post('/order/add',[OrderController::class,'createOrder']);
Route::get('/order',[OrderController::class,'getOrder']);





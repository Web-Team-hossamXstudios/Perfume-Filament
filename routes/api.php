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
*/

//Auth
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    
    //Aut JWT
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'clientProfile']);
    Route::post('/update-profile',[AuthController::class, 'updateProfile']);
    
    //Address
    Route::get('address',[AddressController::class,'getAddress']);
    Route::post('address/create',[AddressController::class,'CreateAddress']);
    Route::post('address_update/{id}',[AddressController::class,'updateAddress']);
    
    //Review
    Route::get('/reviews',[ReviewController::class,'getReviewByClient']);
    Route::post('/reviews/add',[ReviewController::class,'storeReview']);
    
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
});

//Catogory
Route::get('/category',[CategoryController::class,'allCategory']);

//Product
Route::get('/products',[ProductController::class,'allProduct']);
Route::get('/products/featured',[ProductController::class,'ProductWithFeature']);
Route::get('/product/{id}',[ProductController::class,'getProduct']);
Route::get('/products/category/{id}',[ProductController::class,'getProductByCategory']);

//Forget Password
Route::post('/forget_password', [TowFactor::class, 'forgetPassword']);
Route::post('/update/password', [TowFactor::class, 'UpdatePasswordByOtp']);

//Reviews
Route::get('/reviews/product/{id}',[ReviewController::class,'getReviewByProduct']);






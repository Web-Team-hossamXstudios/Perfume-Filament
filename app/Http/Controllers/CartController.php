<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //get cart
    public function getCart(Request $request)
    {
        // Retrieve cart
        $carts = Cart::with('cart_items')->where('client_id', auth('api')->user()->id)->get();
        return response([$carts], 200);
    }

}

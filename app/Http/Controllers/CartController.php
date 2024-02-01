<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //get cart
    public function getCart()
    {
        // Retrieve cart 
        $cart = Cart::with()->where('client_id', auth('api')->user()->id);
        // Check if the carts was found
        if ($cart) {
        // Return the carts 
            return response(['cart' => $cart]);
        } else {
        // Return Not Found 
        return response(['message' => 'Carts not found']);
        }
    }
    //store cart by id
    public function store(Request $request){
        // $cart = Cart::create([
        //     "client_id" => auth('api')->user()->id,
            
        // ]);
        // // Add items to the cart
        // foreach ($request->items as $item) {
        //     $cartItem = CartItem::create([
        //         'cart_id'    => $cart->id,
        //         'product_id' => $request->product_id,
        //         'quantity'   => $request->quantity,
        //         'price'      => $request->price,
        //     ]);
        //     $cart->increment('total_price', $request->price * $request->quantity);
        // }
        // return response()->json  
        // (['message' => 'cart created successfully']);
    }   
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //get all carts
    public function index()
    {
        // Retrieve the carts 
        $carts = Cart::where('client_id', auth('api')->user()->id);
        // Check if the carts was found
        if ($carts) {
        // Return the carts 
            return response()->json(['carts' => $carts]);
        } else {
        // Return Not Found 
        response()->json(['message' => 'Carts not found']);
        }
    }
     //store carts by id
    public function store(Request $request){
        $cart = Cart::create([
            "client_id" => auth('api')->user()->id,
            'total_price' => 0,
        ]);
        // Add items to the cart
        foreach ($request->items as $item) {
            $cartItem = CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'price'      => $request->price,
            ]);
            $cart->increment('total_price', $request->price * $request->quantity);
        }
        return response()->json  
        (['message' => 'cart created successfully']);
    }   
}

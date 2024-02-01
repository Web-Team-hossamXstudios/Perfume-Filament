<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCartItem;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function createCartItem(Request $request){
        $product = Product::find( $request->product_id );
        $cartItem = new CartItem();
        $cartItem->cart_id = $request->user()->cart->id;
        $cartItem->product_id =  $product->id;
        $cartItem->quantity =  $request->quantity;
        $cartItem->price     =  $product->price;
        if ($cartItem->save()) {
            return response ($cartItem,200);
        }else {
            return response ('something went wrong',401);
        }
    }


    public function EditCartItem(Request $request){
        $cartItem = CartItem::find( $request->id );
        $cartItem->quantity =  $request->quantity;
        if ($cartItem->save()) {
            return response ($cartItem,200);
        }else {
            return response ('something went wrong',401);

        }
    }


    public function DeleteCartItem(Request $request){
        $cartItem = CartItem::find($request->id)->Destroy();

    }
}

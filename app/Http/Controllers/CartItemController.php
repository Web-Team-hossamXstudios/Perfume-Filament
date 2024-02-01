<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCartItem;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function createCartItem(Request $request){
    $cartItem = CartItem::create([
        'cart_id'    => $request->id,
        'product_id' => $request->product_id,
        'quantity'   => $request->quantity,
        'price'      => $request->price,
    ]);
}
    public function EditCartItem(UpdateCartItem $request, CartItem $cartItem, $id){
        $cartItem->where('id', $id )->update($request->validated());
        return response([ 'message' => 'Updated successfully',], 200);
    }
    public function DeleteCartItem(CartItem $cartItem, $id){
        $cartItem->where('id', $id )->Destroy();

    }
}

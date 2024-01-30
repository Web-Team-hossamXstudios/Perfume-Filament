<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function store(Request $request, $id){
        $validatedData =$request->validate([
            "product_id"=>"required",
            "quantity"=>"required",

        ]);
        $product = Product::findOrFail($validatedData['product_id']);

        $orderitems=OrderItem::create([
            "product_id"=>$request->product_id,
            "order_id"=>$id,
            "quantity"=>$request->quantity,
            "price"=>$product->price* $request->quantity,
        ]);
        return response()->json([
            "orderitem"=> $orderitems,
        ]);

    }
}

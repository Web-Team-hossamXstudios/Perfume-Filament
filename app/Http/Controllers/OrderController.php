<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request ){

        $order = new Order();
        $order->client_id = $request->user()->id;
        $order->promocode_id = $request->promocode_id;
        $order->total_price = $request->total_price;
        $order->quantity = $request->quantity;
        $order-> status = "pending";


        if ( $order->save()){
            foreach ($request->cartItem as $item)
                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->product_id = $item->product_id;
                $order_item->quantity = $item->quantity;
                $order_item->price = $item->price;

        }
        if($order_item->save())
        {
            $request->cartItem->delete();
        }
        else
        {

        }
        return response()->json([
            "order"=> $order,
            "orderItems"=> $order_item
        ]);
        // save orderitem and and check where by product_id and order id then delete
    }
    // promo
    public function delete(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }

}

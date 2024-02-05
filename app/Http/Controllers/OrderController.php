<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Promocode;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class OrderController extends Controller
{
    public function createOrder(Request $request ){
        $subtotal = 0;
        $settings= Setting::get()->first();
        $taxe= $settings->taxe;
        $service= $settings->service;
        $cart= Cart::with('cart_items')->where('client_id',auth('api')->user()->id)->first();
        $order = new Order();
        $order->client_id = auth('api')->user()->id;
        if($request->code){
            $promocode = Promocode::where('code',$request->code)->first();
            $promocode_client = Order::with('promocode')->where('client_id',auth('api')->user()->id)->first();
            if($promocode->id  == $promocode_client->id){
                return response(['error' => 'code is used'], 401);
            }else{
                $order->promocode_id = $promocode->id;
            }
        }
        $order->total_price = $subtotal;
        $order-> status = "pending";
        if ($order->save()){
            foreach ($cart->cart_items as $item){
                // create new orderItem
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item->product_id;
                $orderItem->quantity = $item->quantity;
                $orderItem->price = $item->total;
                $order->save();
                if($orderItem->save()){
                    $subtotal += $item->total;
                    CartItem::destroy($item->id);
                }else{
                    return response(['error' => 'somthing wrong'], 401);
                }
            }
            if($request->code){
                $totalPrice = $subtotal + $service + $taxe - ($subtotal * $promocode->value/100);
            }else{
                $totalPrice = $subtotal + $service + $taxe ;
            }
            $order->total_price = $totalPrice;
            $order->save();
            $transaction = new Transaction();
            $transaction->order_id = $order->id;
            $transaction->type = $request->type;
            $transaction->amount = $order->total_price;
            $transaction->save();
            return response($order,200);
        }else{
            return response(['error' => 'somthing wrong'], 401);
        }

    }
    public function delete(Order $order)
    {
        $order->delete();
        return response(null, 204);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promocode;
use App\Models\Setting;
use Illuminate\Http\Request;

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
        $promocode = Promocode::where('code',$request->code)->first();
        $order->promocode_id = $promocode->id;
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
            $totalPrice = $subtotal + $service + $taxe;
            $order->total_price = $totalPrice;
            $order->save();
            return response([$order,$orderItem],200);
        }else{
            return response(['error' => 'somthing wrong'], 401);
        }

    }
    // promo
    public function allPromo(Request $promo_code)
    {
        $promo = Order::where('promocode_id',$promo_code)->first();

    }
    public function delete(Order $order)
    {
        $order->delete();
        return response(null, 204);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Promocode;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(Request $request ){
        $subtot = 0;
        $order = new Order();
        $order->client_id = $request->user()->id;
        $order->promocode_id = $request->promocode_id;
        $order->total_price = $subtot;
        $order-> status = "pending";

        $cartitems= CartItem::find($request->cartitem_id);
        if ( $order->save()){
            foreach ($cartitems as $item){
                $order_item = new OrderItem();
                $order_item->order_id = $order->id;
                $order_item->product_id = $cartitems->product_id;
                $order_item->quantity = $cartitems->quantity;
                $order_item->price = $cartitems->quantity *  $cartitems->price ;
                   //edit order
                $subtot = $subtot + ($cartitems->quantity *  $cartitems->price  );
                //    $subtot= Order::find($order->id );
                //   $tot= $order->total_price = $subtot;
                //    $subtot->update();

                if($order_item->save()){
                    $cartitem = CartItem::where('product_id',$order_item->product_id)->delete();
                }
            }
               return response([
                $order, 200 ,
                $order_item,200
            ]);
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

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    public function allPromo(Request $promo_code)
    {
        $promo = Order::where('promocode_id', null )->first();

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //get favourites by id
    public function getFavourite(){
        $favourites = Favourite::where('client_id', auth('api')->user()->id);
        return response(['favourites' => $favourites ]);
    }

    //store favourites by id
    public function create(Request $request){
        Favourite::createFavourite([
            "client_id"=>auth('api')->user()->id,
            "product_id"=> $request->product_id,
        ]);
        return response()->json
        (['message' => 'Review created successfully']);
    }
        
}

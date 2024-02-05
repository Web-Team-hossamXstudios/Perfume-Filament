<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //get favourites
    public function getFavourite(){
        $favourites = Favourite::where('client_id', auth('api')->user()->id)->get();
        return response([ $favourites ], 201);
    }

    //store favourites
    public function createFavourite(Request $request){
        $existingFavorite = Favourite::where('client_id', auth('api')->user()->id)
        ->where('product_id', $request->product_id)
        ->first();
        if ($existingFavorite) {
            return response()->json(['message' => 'Product already in favorites']);
        }

        $favourite = new Favourite();
        $favourite->client_id = $request->user()->id;
        $favourite->product_id = $request->product_id;
        if($favourite->save()) {
            return response ($favourite,200);
        }else {
            return response ('something went wrong',401);
        }

    }
    //delete favourite
    public function deleteFavourite(Request $request){

        $favorite = Favourite::where('client_id', auth('api')->user()->id)
            ->where('product_id', $request->product_id)
            ->first();

        $favorite->delete();

        return response($favorite, 401);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    //get reviews by id
    public function index(){
        $reviews = Review::where('client_id', auth('api')->user()->id)->get();
        return response()->json
        (['reviews' => $reviews ]);
    }

    //store reviews by id
    public function store(Request $request, $product_id){
        $validatedData=$request->validate([
            "rating"=>"required",
            "comment"=>"required",
        ]);

        Review::create([
            "client_id" => auth('api')->user()->id,
            "product_id"=> $$request->product_id,
            "rating"    => $request->rating,
            "comment"   => $request->comment,
        ]);
        return response()->json
        (['message' => 'Review created successfully']);
    }
}

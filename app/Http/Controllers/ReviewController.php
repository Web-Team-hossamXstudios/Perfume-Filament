<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    //get reviews by id
    public function getReviewByClient(){
        $reviews = Review::where('client_id', auth('api')->user()->id)->get();
        return response([ $reviews ], 200);
    }

    //store reviews by id
    public function storeReview(Request $request){
        $review = new Review();
        $review->client_id = $request->user()->id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->product_id = $request->product_id;
        if($review->save()) {
            return response ($review,200);
        }else {
            return response ('something went wrong',401);
        }
    }

    public function getReviewByProduct($id){
        $product = Review::where('product_id', $id)->get();
        return response ($product,200);


    }
}

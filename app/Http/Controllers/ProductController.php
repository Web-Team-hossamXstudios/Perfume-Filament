<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //get all products
    public function allProduct()
    {
        $products= Product::all();
        foreach ($products as $product) {
            $product->getMedia('products')->first();
        }
        return response(['products' => $products]);
    }


    public function show($id)
    {
        // Retrieve the product
        $reviews = Review::get()->where('product_id',$id);
        $product = Product::find($id);
        // Check if the product was found
        if ($product) {
        // Return the product
            return response(['Product' =>$product, 'Reviews' => $reviews]);
        } else {
        // Return Not Found
        response(['message' => 'Product not found']);
        }
    }
}


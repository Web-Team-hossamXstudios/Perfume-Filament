<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //get all products
    public function index(){
        $products = Product::all();
        return response()->json
        (['Products' => $products]);
    }


    public function show($id)
    {
        // Retrieve the product
        $product = Product::with('reviews')->find($id);
        // Check if the product was found
        if ($product) {
        // Return the product
            return response()->json([
                'Product' =>$product
            ]);
        } else {
        // Return Not Found
        response()->json(['message' => 'Product not found'],);
        }
    }

}

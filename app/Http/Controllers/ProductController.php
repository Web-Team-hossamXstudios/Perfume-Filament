<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
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


    public function getProduct($id)
    {
        // Retrieve the product
        $product = Product::find($id);
        // Retrieve the reviews
        $reviews = Review::get()->where('product_id',$id);
        // Check if the product was found
        if ($product) {
        // Return the product
            return response(['Product' =>$product, 'Reviews' => $reviews]);
        } else {
        // Return Not Found
        response(['message' => 'Product not found']);
        }
    }


    public function getProductByCategory($id)
    {
        // Retrieve the product
        $product = Product::get()->where('category_id',$id);
        // Check if the product was found
        if ($product) {
        // Return the product
            return response(['Product' =>$product]);
        } else {
        // Return Not Found
        response(['message' => 'Product not found']);
        }
    }
    public function ProductWithFeature(){
        $products= Product::all()->where('is_feature',1);
        return response([$products], 200);

    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category= Category::all();
//        $category->addMediaFromRequest('category')->toMediaCollection('images');
        return response()->json($category);
//        $media =$category->getMedia();
//        return response()->json(['media'=> $media]);

    }
}

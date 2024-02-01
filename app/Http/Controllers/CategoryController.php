<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories= Category::all();
        foreach ($categories as $category) {
            $category->getMedia('categories');
        }
        return response()->json($categories);
//        return response()->json(['media'=> $media]);

    }
}

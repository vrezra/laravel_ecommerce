<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        return response()->json([
            'success' => true,
            'data' => ProductResource::collection(Product::all())
        ]);
    }

    public function  show($id){
        return response()->json([
            'success' => true,
            'data' => new ProductResource(Product::findOrFail($id))
        ]);
    }
}

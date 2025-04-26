<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $products = Product::all();

        return response()->json([
            $products,
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function singleProduct(Request $request, Product $product)
    {
        return response()->json([
            $product,
        ],200);
    }
}

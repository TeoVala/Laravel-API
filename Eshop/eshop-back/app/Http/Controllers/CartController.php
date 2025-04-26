<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Auth::user()->cart;

        return (new CartResource($cart))
        ->load('products');

    }


    public function store(Request $request)
    {
        $cart = Auth::user()->cart;
        $productId = $request->input('product_id');
        $theProduct = Product::find($productId);

        if (!$cart) {
            $cart = Cart::create([
                'user_id' => Auth::user()->id
            ]);

            $cart->products()->attach($theProduct);

            return response()->json([
                'message' => 'Cart didn\'t exist created new',
            ], 200);
        }

        $existingProduct = $cart->products()->where('product_id', $productId)->first();

        if (!$existingProduct) {
            $cart->products()->attach($theProduct);
        }

        // return response()->json($cart);
        return response()->json([
            $existingProduct,
            'req'=>$request->input('product_id'),
            'Succesfully added product to cart',
        ], 200);
    }
}

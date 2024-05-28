<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        
        if(!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cart = Session::get('cart', []);
        $cart[$product->id] = [
            'product_id' => $product->id,
            'name' => $product->nama_product,
            'price' => $product->harga,
            'quantity' => $request->quantity,
            'image' => $product->image_path
        ];

        Session::put('cart', $cart);

        return response()->json(['success' => 'Product added to cart']);
    }
}
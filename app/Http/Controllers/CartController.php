<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        $cartProduct = $cart->products()->where('product_id', $productId)->first();
        if ($cartProduct) {
            $cartProduct->pivot->quantity += $quantity;
            $cartProduct->pivot->total_price = $cartProduct->pivot->quantity * $cartProduct->pivot->price;
            $cartProduct->pivot->save();
        } else {
            $cart->products()->attach($productId, [
                'quantity' => $quantity,
                'price' => $product->harga,
                'total_price' => $quantity * $product->harga
            ]);
        }

        return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function showCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('products')->first();
        return view('cart', compact('cart'));
    }
}

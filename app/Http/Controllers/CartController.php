<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('product')->where('customer_id', Auth::id())->get();
        return view('cart', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $user_id = Auth::id();
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $quantity = $request->quantity;
        $price = $product->harga;
        $total_price = $price * $quantity;

        $cart = Cart::updateOrCreate(
            ['customer_id' => $user_id, 'product_id' => $request->product_id],
            ['quantity' => $quantity, 'price' => $price, 'total_price' => $total_price]
        );

        return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang!']);
    }
}

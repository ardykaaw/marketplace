<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addProduct(Request $request)
    {
        $productId = $request->input('product_id');
        Log::info('Menambahkan produk ke keranjang dengan ID: ' . $productId);
        $product = Product::find($productId);

        if (!$product) {
            Log::error('Produk dengan ID ' . $productId . ' tidak ditemukan');
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Implementasi penambahan produk ke keranjang
        return response()->json(['message' => 'Produk telah berhasil ditambahkan ke keranjang']);
    }

    public function addProductToCart(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cart = session()->get('cart', []);
        $cart[$productId] = [
            "quantity" => $quantity,
            "price" => $product->price,
            "total_price" => $product->price * $quantity
        ];

        session()->put('cart', $cart);

        return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function displayCart()
    {
        $carts = session()->get('cart', []);
        if (empty($carts)) {
            return view('cart')->with('message', 'Keranjang belanja Anda kosong.');
        }
        return view('cart', ['carts' => $carts]);
    }
}

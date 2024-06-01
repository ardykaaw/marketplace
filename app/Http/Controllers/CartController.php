<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
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

        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $productId],
            ['quantity' => 1, 'price' => $product->harga, 'total_price' => $product->harga]
        );

        return response()->json(['message' => 'Produk telah berhasil ditambahkan ke keranjang']);
    }

    public function addProductToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default quantity to 1 if not provided
        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cart = Cart::updateOrCreate(
            ['user_id' => Auth::id(), 'product_id' => $productId],
            ['quantity' => DB::raw("quantity + $quantity"), 'price' => $product->harga, 'total_price' => DB::raw("total_price + " . ($product->harga * $quantity))]
        );

        return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default quantity to 1 if not provided
        $user_id = auth()->id(); // Asumsi user sudah login

        // Cari produk untuk mendapatkan harga
        $product = Product::find($product_id);
        if (!$product) {
            return response()->json(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }

        // Hitung total harga
        $total_price = $product->harga * $quantity;

        // Buat record baru di tabel carts
        Cart::create([
            'customer_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $product->harga,
            'total_price' => $total_price
        ]);

        return response()->json(['status' => 'success']);
    }

    public function displayCart()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($carts->isEmpty()) {
            return view('cart')->with('message', 'Keranjang belanja Anda kosong.');
        }

        return view('cart', ['carts' => $carts]);
    }
}

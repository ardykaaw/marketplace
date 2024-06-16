<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; // Tambahkan ini untuk mengatasi undefined type 'App\Http\Controllers\DB'
use App\Models\Order; // Tambahkan ini untuk mengatasi undefined type 'App\Http\Controllers\Order'

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Log::info('Add to cart request received', ['user_id' => Auth::id(), 'product_id' => $request->input('product_id')]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }

        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Menggunakan syncWithoutDetaching untuk menghindari duplikasi
        $cart->products()->syncWithoutDetaching([$productId => [
            'quantity' => $quantity,
            'price' => $product->harga,
            'total_price' => $quantity * $product->harga
        ]]);

        return response()->json(['success' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function updateCart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = Cart::where('user_id', $userId)->first();
        $cartProduct = $cart->products()->where('product_id', $productId)->first();

        if ($cartProduct) {
            $cartProduct->pivot->quantity = $quantity;
            $cartProduct->pivot->save();
        }

        return response()->json(['success' => 'Kuantitas produk diperbarui']);
    }

    public function removeProductFromCart(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $cart = Cart::where('user_id', $userId)->first();
        $cart->products()->detach($productId);

        return response()->json(['success' => 'Produk dihapus dari keranjang']);
    }

    public function showCart()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('products')->first();
        return view('cart', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->with('products')->first();

        if (!$cart) {
            return redirect()->back()->with('error', 'Keranjang Anda kosong.');
        }

        DB::beginTransaction();
        try {
            foreach ($cart->products as $product) {
                Order::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                    'status' => 'pending',
                    'payment_method' => $request->payment_method,
                    'image_path' => $product->image_path
                ]);
            }

            // Kosongkan keranjang setelah checkout
            $cart->products()->detach();

            DB::commit();
            return redirect()->route('profile.riwayatPesanan')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat pesanan.');
        }

        $validatedData = $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'payment_method' => 'required|string'
        ]);

        // Proses penyimpanan data atau transaksi pembayaran
        try {
            // Simulasi proses transaksi
            // Misalnya menyimpan ke database
            Order::create($validatedData);
            return response()->json(['success' => 'Order processed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error processing order'], 500);
        }
    }

    public function success()
    {
        try {
            return view('orders.success');
        } catch (\Exception $e) {
            Log::error('Error displaying success page: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan halaman sukses.');
        }
    }

    public function show($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            return view('orders.show', compact('product'));
        } catch (\Exception $e) {
            Log::error('Error displaying product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan produk.');
        }
    }

    public function index()
    {
        try {
            $orders = Order::all();
            return view('orders.index', compact('orders'));
        } catch (\Exception $e) {
            Log::error('Error displaying orders: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan pesanan.');
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json(['success' => 'Pesanan berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menghapus pesanan'], 500);
        }
    }
}

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
        Log::info('Received data:', $request->all());
        if (!auth()->check()) {
            return response()->json(['error' => 'Anda harus login untuk membuat pesanan.'], 401);
        }

        $validatedData = $request->validate([
            'payment_method' => 'required|string',
            // Validasi data lainnya
        ]);

        $order = new Order();
        $order->user_id = auth()->id();
        $order->payment_method = $validatedData['payment_method'];
        $order->status = 'pending';
        // Set properties lainnya
        $order->save();

        return response()->json(['success' => 'Order processed successfully']);
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

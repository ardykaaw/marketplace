<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Pastikan pengguna terautentikasi
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Anda harus login untuk membuat pesanan.');
            }

            // Validasi data pesanan
            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'payment_method' => 'required|in:credit_card,bank_transfer',
            ]);

            // Simpan pesanan ke database
            $order = new Order();
            $order->fill([
                'product_id' => $validatedData['product_id'],
                'user_id' => auth()->id(),
                'payment_method' => $validatedData['payment_method'],
                'status' => 'pending',
            ]);
            $order->save();

            // Redirect dengan pesan sukses
            return redirect()->route('orders.success')->with('success', 'Pembayaran berhasil dikonfirmasi');
        } catch (\Exception $e) {
            Log::error('Error processing payment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
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

    public function delete($id)
    {
        try {
            $order = Order::findOrFail($id);

            // Cek apakah pengguna yang login adalah pemilik pesanan
            if ($order->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $order->delete();
            return response()->json(['success' => 'Pesanan berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}

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
            $user = auth()->user();
            foreach ($request->products as $prod) {
                $order = new Order();
                $order->user_id = $user->id;
                $order->product_id = $prod['product_id'];
                $order->quantity = $prod['quantity'];
                $order->status = 'pending';
                $order->save();
            }

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
        Log::info("Attempting to delete order with ID: $id");
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            Log::info("Order deleted successfully.");
            return response()->json(['success' => 'Pesanan berhasil dihapus']);
        } else {
            Log::error("Order not found.");
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }
    }
}

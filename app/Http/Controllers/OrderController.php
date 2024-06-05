<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk mengatasi masalah undefined type Log

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Pastikan pengguna terautentikasi
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk membuat pesanan.');
        }

        // Validasi data pesanan
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|in:credit_card,bank_transfer', // Sesuaikan dengan metode yang valid
        ]);

        // Simpan pesanan ke database
        $order = new Order();
        $order->product_id = $request->input('product_id');
        $order->user_id = auth()->id();
        $order->payment_method = $request->input('payment_method');
        $order->status = 'pending';
        $order->save();

        // Redirect ke halaman riwayat pesanan
        return redirect()->route('orders.success');
    }

    public function success()
    {
        return view('orders.success');
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('orders', compact('product'));
    }

    public function index()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            echo $order->user_id; // Langsung mengakses user_id
        }
        // Atau kirim data ke view
        return view('orders.index', compact('orders'));
    }

    public function delete($id)
    {
        Log::info('Delete request received for order ID: ' . $id); // Gunakan Log dengan namespace yang benar
        $order = Order::find($id);
        if ($order) {
            $order->delete();
            Log::info('Order deleted successfully'); // Gunakan Log dengan namespace yang benar
            return response()->json(['success' => 'Pesanan berhasil dihapus']);
        } else {
            Log::error('Order not found'); // Gunakan Log dengan namespace yang benar
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }
    }
}

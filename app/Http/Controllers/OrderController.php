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
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'payment_method' => 'required|in:credit_card,bank_transfer',
        ]);

        DB::beginTransaction();
        try {
            $user = auth()->user();
            foreach ($request->products as $prod) {
                $order = new Order();
                $order->user_id = $user->id;
                $order->product_id = $prod['product_id'];
                $order->quantity = $prod['quantity'];
                $order->payment_method = $request->payment_method;
                $order->status = 'pending';
                $order->save();
            }
            DB::commit();
            return redirect()->route('profile.riwayatPesanan')->with('success', 'Pesanan berhasil dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
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

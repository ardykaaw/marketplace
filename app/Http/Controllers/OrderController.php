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
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'payment_method' => 'required|in:BCA,BRI,BNI',
            'quantity' => 'required|integer|min:1'
        ]);

        // Mulai transaksi
        DB::beginTransaction();

        try {
            $product = Product::lockForUpdate()->find($validated['product_id']);

            if (!$product) {
                return response()->json(['success' => false, 'error' => 'Produk tidak ditemukan.']);
            }

    
            // Simpan order
            $order = new Order();
            $order->fill([
                'user_id' => auth()->id(),
                'product_id' => $validated['product_id'],
                'payment_method' => $validated['payment_method'],
                'quantity' => $validated['quantity'],
                'status' => 'pending',
                'image_path' => $product->image_path,
                'name_product' => $product->name_product,
                'harga' => $product->harga
            ]);
            $order->save();

            // Commit transaksi
            DB::commit();

            return response()->json(['success' => true, 'redirect' => route('orders.success')]);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::RollBack();
            Log::error('Error processing order: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Gagal memproses pesanan.']);
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

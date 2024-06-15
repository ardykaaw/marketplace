<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order; 
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', ['user' => auth()->user()]);
    }

    public function view()
    {
        return view('profile.view', ['user' => auth()->user()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }

    public function riwayatPesanan()
    {
        $user_id = auth()->id(); // Mendapatkan ID pengguna yang sedang login
        $orders = Order::where('user_id', $user_id)->with('product')->get(); // Mengambil pesanan yang hanya terkait dengan pengguna tersebut

        return view('profile.riwayatPesanan', compact('orders'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'address' => 'required|string|max:255'
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email', 'address']));

        return redirect()->route('profile.view')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Menampilkan detail produk berdasarkan ID.
     *
     * @param  int  $id  ID produk yang ingin ditampilkan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('products.show', ['product' => $product]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Pesanan tidak ditemukan'], 404);
        }

        if ($order->user_id !== auth()->id()) {
            return response()->json(['error' => 'Tidak memiliki izin'], 403);
        }

        $order->delete();
        return response()->json(['success' => 'Pesanan berhasil dihapus']);
    }
}

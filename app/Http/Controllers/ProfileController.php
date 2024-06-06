<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Order; // Tambahkan ini untuk mendefinisikan tipe Order
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile.index', compact('user'));
    }

    public function view()
    {
        $user = auth()->user();
        return view('profile.view', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function riwayatPesanan()
    {
        $user = auth()->user();
        return view('profile.riwayatPesanan', compact('user'));
    }
    
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'address' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->save(); // Ganti save() dengan update()

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
            return view('products.show', compact('product'));
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

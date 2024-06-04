<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

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
        \Log::info('Request method:', ['method' => $request->method()]);
        $user = auth()->user();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|min:6|confirmed'
        ]);
        User::where('id', $user->id)->update($validatedData);
        return redirect()->route('profile.view');
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
}


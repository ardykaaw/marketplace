<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product; // Tambahkan model Product
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Method untuk menampilkan form membuat review
    public function create()
    {
        return view('review.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id', // Tambahkan validasi untuk product_id
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $product = Product::find($validatedData['product_id']); // Ambil data produk berdasarkan product_id

        Review::create([
            'user_id' => Auth::id(), // Menambahkan user_id dari pengguna yang sedang login
            'order_id' => $validatedData['order_id'],
            'product_id' => $validatedData['product_id'], // Simpan product_id
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['comment'],
        ]);

        return redirect()->back()->with('success', 'Ulasan untuk produk ' . $product->nama_product . ' berhasil disimpan.');
    }
}

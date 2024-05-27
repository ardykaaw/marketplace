<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // Tambahkan model Review
use Illuminate\Support\Facades\Auth; // Tambahkan facade Auth

class ReviewController extends Controller
{
    // Method untuk menampilkan form membuat review
    public function create()
    {
        return view('review.create'); // Pastikan Anda memiliki view yang sesuai
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        Review::create($validatedData);

        return redirect()->back()->with('success', 'Ulasan berhasil disimpan.');
    }
}


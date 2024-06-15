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
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
            'subject' => 'required|string|max:255'
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'subject' => $request->subject
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil ditambahkan.');
    }
}

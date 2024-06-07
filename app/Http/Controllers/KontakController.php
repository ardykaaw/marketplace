<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function store(Request $request)
    {
        $review = new Review();
        $review->user_id = $request->user_id; // Pastikan Anda memiliki user_id atau sesuaikan logika ini
        $review->product_id = $request->product_id; // Sesuaikan dengan input form jika perlu
        $review->rating = $request->rating; // Tambahkan input rating di form jika perlu
        $review->comment = $request->pesan;
        $review->save();

        return redirect('/kontak')->with('success', 'Review telah berhasil disimpan.');
    }
}
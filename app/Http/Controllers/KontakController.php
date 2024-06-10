<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak');
    }

    public function submitKontak(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'nama' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'pesan' => 'required|string',
        ]);

        Review::create([
            'user_id' => $validatedData['user_id'],
            'product_id' => $validatedData['product_id'],
            'rating' => $validatedData['rating'],
            'comment' => $validatedData['pesan'],
            'subject' => $validatedData['subject'],
        ]);

        return redirect()->back()->with('success', 'Review berhasil dikirim.');
    }
}

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
        try {
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
        } catch (\Exception $e) {
            \Log::error('Error saving review: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambahkan ulasan.');
        }
    }

    public function exportToXml()
    {
        $reviews = Review::all();
        $xml = new \SimpleXMLElement('<reviews/>');

        foreach ($reviews as $review) {
            $item = $xml->addChild('review');
            $item->addChild('id', $review->id);
            $item->addChild('product_id', $review->product_id);
            $item->addChild('user_id', $review->user_id);
            $item->addChild('rating', $review->rating);
            $item->addChild('comment', $review->comment);
            // Tambahkan field lain sesuai kebutuhan
        }

        return response($xml->asXML(), 200)
                  ->header('Content-Type', 'application/xml');
    }
}

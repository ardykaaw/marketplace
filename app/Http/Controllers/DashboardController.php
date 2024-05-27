<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Tambahkan ini untuk mengatasi masalah undefined type

class DashboardController extends Controller
{
    public function stats()
    {
        // Anda bisa menambahkan logika untuk mengambil data statistik di sini
        $products = Product::all(['name', 'price', 'description']); // Pindahkan baris ini ke dalam fungsi
        return view('admin.dashboard', compact('products')); // Pastikan Anda memiliki view ini dan kirimkan data products
    }
}

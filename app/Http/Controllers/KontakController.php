<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product; // Added this line to import the Product model

class KontakController extends Controller
{
    public function index()
    {
        // Anda bisa menambahkan logika untuk mengambil data yang diperlukan atau langsung mengembalikan view
        return view('kontak'); // Pastikan Anda memiliki file view 'kontak.blade.php'
    }
}

/* Start of Selection */
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Tambahkan ini untuk mengatasi masalah "Class 'Product' not found"
use App\Models\Order; // Pastikan model Order sudah ada dan terhubung dengan database yang benar
use App\Models\User; // Pastikan model User sudah ada dan terhubung dengan database yang benar

class DashboardController extends Controller
{
    public function stats()
    {
        $products = Product::all(['nama_product', 'harga', 'spesifikasi']);
        $totalUsers = User::count();
        $totalOrders = Order::count(); // Menghitung jumlah total pesanan
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->sum('total');

        return view('admin.dashboard', compact('products', 'totalUsers', 'monthlyRevenue', 'totalOrders'));
    }
}

/* End of Selection */

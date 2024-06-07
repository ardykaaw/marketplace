/* Start of Selection */
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        $products = Product::all(['nama_product', 'harga', 'spesifikasi']);
        $totalUsers = User::count();
        $totalOrders = Order::count();
        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
                               ->whereYear('created_at', now()->year)
                               ->sum('total');

        return view('admin.dashboard', compact('products', 'totalUsers', 'monthlyRevenue', 'totalOrders'));
    }
}

/* End of Selection */

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Review;
use App\Models\Kontak;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function stats()
    {
        // Fetch data from the database
        $totalProduct = Product::count(); // Count total products
        $totalUsers = User::count(); // Count total users
        $totalOrders = Order::count(); // Count total orders
        $totalReviews = Review::count(); // Count total reviews
        $totalKontak = Kontak::count(); // Count total contacts

        $monthlyRevenue = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total'); // Calculate revenue

        // Pass all variables to the view
        return view('admin.dashboard', compact(
            'totalProduct',
            'totalUsers',
            'totalOrders',
            'totalReviews',
            'totalKontak',
            'monthlyRevenue'
        ));
    }

    public function index()
    {
        // Existing code...
        $totalRevenue = Order::sum('amount'); // Example for total revenue
        $totalComments = Comment::count(); // Example for total comments

        return view('admin.dashboard', compact('totalUsers', 'totalProduct', 'totalOrders', 'totalReviews', 'totalKontak', 'totalRevenue', 'totalComments'));
    }
}

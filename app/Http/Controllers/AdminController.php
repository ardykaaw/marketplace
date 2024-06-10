<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $products = Product::paginate(10); // Menggunakan pagination
        $orders = Order::paginate(10); // Menggunakan pagination
        $reviews = Review::paginate(10); // Menggunakan pagination

        return view('admin.dashboard', compact('products', 'orders', 'reviews'));
    }

    public function createProduct()
    {
        return view('admin.create_product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Product created successfully.');
    }

    public function editProduct(Product $product)
    {
        return view('admin.edit_product', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|nullable'
        ]);

        $product->nama_product = $request->name;
        $product->harga = $request->price;
        $product->spesifikasi = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('admin.edit_product', $product->id)->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully.');
    }

    public function orders()
    {
        $orders = Order::with('user')->get();
        if ($orders->isEmpty()) {
            // Handle kasus jika tidak ada order
            return view('admin.orders', ['orders' => $orders, 'message' => 'Tidak ada order yang ditemukan.']);
        }
        return view('admin.orders', ['orders' => $orders]);
    }

    public function reviews()
    {
        $reviews = Review::with('user')->get(); // Gunakan eager loading
        return view('admin.reviews', compact('reviews'));
    }
    public function orderDetails(Order $order)
    {
        // Anda bisa menambahkan logika untuk mengambil data detail order
        return view('admin.order_details', compact('order'));
    }

    public function confirmOrder(Order $order)
    {
        // Logika untuk konfirmasi order
        $order->status = 'confirmed';
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Order berhasil dikonfirmasi.');
    }

    public function showProducts()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }
}

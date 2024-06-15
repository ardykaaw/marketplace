<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Produk berhasil dihapus.');
    }

    public function update(Request $request)
    {
        $product = Product::latest()->first();
        $product->update($request->all());
        return redirect()->route('admin.view_product');
    }

    public function viewAll()
    {
        return ('admin.view_product');
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.product.show', compact('product'));
    }

    public function dashboard()
    {
        $products = Product::all(); // Ambil semua produk atau sesuai kebutuhan
        return view('admin.dashboard', compact('products'));
    }
}

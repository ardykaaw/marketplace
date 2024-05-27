<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Tambahkan model Product

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->input('type', 'all'); // Default adalah 'all'
        if ($type == 'all') {
            $products = Product::all();
        } else {
            // Menggunakan query builder untuk mencari produk berdasarkan kata kunci di image_path
            $products = Product::where('image_path', 'like', '%' . $type . '%')->get();
        }

        // Mengembalikan view dashboard yang berisi daftar produk
        return view('produk', compact('products'));
        // Pastikan Anda memiliki file view di resources/views/admin/dashboard.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_product' => 'required', // Tambahkan validasi untuk memastikan nama_product diisi
            'harga' => 'required',
            'spesifikasi' => 'required',
            'image' => 'required|image'
        ]);

        $product = new Product();
        $product->nama_product = $request->nama_product;
        $product->harga = $request->harga;
        $product->spesifikasi = $request->spesifikasi;
        $product->image_path = $request->file('image')->store('public/images');

        $product->save();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Menampilkan detail produk.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
     public function show($id)
     {
         $product = Product::find($id);
         if (!$product) {
             return redirect()->route('admin.dashboard')->with('error', 'Produk tidak ditemukan.');
         }
         return view('orders', compact('product'));
     }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit_product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|nullable'
        ]);

        $product = Product::findOrFail($id);
        $product->nama_product = $request->name;
        $product->harga = $request->price;
        $product->spesifikasi = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
            $product->image_path = $path;
        }

        $product->save();

        return redirect()->route('admin.edit_product', $id)->with('success', 'Produk berhasil diperbarui.');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('admin.manage_products')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->route('admin.manage_products')->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function manage()
    {
        $products = Product::all(); // Mengambil semua produk
        return view('admin.manage_products', compact('products'));
    }
}


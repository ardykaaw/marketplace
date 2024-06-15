<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Tambahkan model Product

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $query->where('nama_product', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('produk', compact('products'));
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

    public function destroy($id)
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

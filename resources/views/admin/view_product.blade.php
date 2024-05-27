<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Detail Produk
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $product->nama_product }}</h5>
            <p class="card-text">Harga: Rp{{ number_format($product->harga, 2) }}</p>
            <p class="card-text">Spesifikasi: {{ $product->spesifikasi }}</p>
            <div class="text-center">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Gambar Produk" class="img-fluid">
            </div>
            <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-primary mt-3">Edit Produk</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #2c2f33;
            color: #fff;
        }
        .sidebar {
            background-color: #232946;
            height: 100vh;
            padding-top: 20px;
            width: 400px; /* Lebar sidebar diubah dari default menjadi 250px */
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #1f1f1f;
        }
        .content {
            margin-left: 400x; /* Margin kiri diubah sesuai dengan lebar sidebar baru */
            padding: 20px;
        }
        .card {
            background-color: #3a3f47;
            border: none;
            margin-bottom: 20px;
        }
        .card h5, .card p {
            color: #fff;
        }
        .table {
            color: #fff;
        }
        .table th, .table td {
            border-top: 1px solid #444;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="text-center">ADMIN</h2>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.create_product') }}">Add Product</a>
            <a href="{{ route('admin.orders') }}">Orders</a>
            <a href="{{ route('admin.reviews') }}">Reviews</a>
        </div>
        <!-- Main Content -->
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="background-color: #e63946;">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #f1faee;">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #a8dadc;">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="background-color: #457b9d;">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div the="card" style="background-color: #1d3557;">
                        <div class="card-body">
                            <h5 class="card-title">Card Title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        </div>
                    </div>
                </div>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products ?? [] as $product)
                        <tr>
                            <td>{{ $product->nama_product }}</td>
                            <td>Rp{{ number_format($product->harga, 2, ',', '.') }}</td>
                            <td>{{ $product->spesifikasi }}</td>
                            <td>
                                <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Tidak ada produk yang tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard') }}">
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
                @php
                    use App\Models\User;
                    $totalUsers = User::count();
                    $cards = [
                        ['color' => '#e63946', 'title' => 'Total Produk', 'text' => 'Jumlah total produk yang tersedia di toko.'],
                        ['color' => '#000000', 'title' => 'Total Pesanan', 'text' => 'Jumlah total pesanan yang telah diterima.'],
                        ['color' => '#a8dadc', 'title' => 'Total Ulasan', 'text' => 'Jumlah total ulasan yang diberikan oleh pelanggan.'],
                        ['color' => '#457b9d', 'title' => 'Pendapatan Bulanan', 'text' => 'Total pendapatan yang diperoleh dalam bulan ini: Rp'],
                        ['color' => '#1d3557', 'title' => 'Pengguna Terdaftar', 'text' => 'Jumlah total pengguna yang terdaftar di aplikasi: ' . $totalUsers]
                    ];
                    $products = Product::all(['nama_product', 'harga', 'spesifikasi']);
                @endphp

                @foreach ($cards as $card)
                    <div class="col-md-4">
                        <div class="card" style="background-color: {{ $card['color'] }};">
                            <div class="card-body">
                                <h5 class="card-title">{{ $card['title'] }}</h5>
                                <p class="card-text">{{ $card['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->nama_product }}</td>
                            <td>Rp{{ number_format($product->harga, 2, ',', '.') }}</td>
                            <td>{{ $product->spesifikasi }}</td>
                            <td>
                                <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

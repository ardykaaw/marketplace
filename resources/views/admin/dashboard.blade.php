<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2 class="text-center">ADMIN</h2>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('admin.create_product') }}">Add Product</a>
                <a class="nav-link" href="{{ route('admin.orders') }}">Orders</a>
                <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
            </nav>
        </div>
        <!-- Main Content -->
        <div class="content">
            <div class="row">
                @php
                    use App\Models\User;
                    use App\Models\Product;
                    $totalUsers = User::count();
                    $products = Product::all();
                    $cards = [
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Produk',
                            'text' => 'Jumlah total produk yang tersedia di toko.',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Pesanan',
                            'text' => 'Jumlah total pesanan yang telah diterima.',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Ulasan',
                            'text' => 'Jumlah total ulasan yang diberikan oleh pelanggan.',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Pendapatan Bulanan',
                            'text' => 'Total pendapatan yang diperoleh dalam bulan ini: Rp',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Pengguna Terdaftar',
                            'text' => 'Jumlah total pengguna yang terdaftar di aplikasi: ' . $totalUsers,
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-md-4 mb-3">
                        <div class="card text-white" style="background-color: {{ $card['color'] }};">
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
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->nama_product }}</td>
                            <td>Rp{{ number_format($product->harga, 2, ',', '.') }}</td>
                            <td>@php
                                $specification = explode("\n", $product->spesifikasi);
                            @endphp

                            @foreach ($specification as $spec)
                                {{ $spec }}<br>
                            @endforeach</td>
                            <td>
                                <a href="{{ route('admin.edit_product', $product->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a2.121 2.121 0 1 1 3 3L12 15l-4 1l1-4Z"/></g></svg>
                                </a>
                                <!-- Tombol Hapus -->
                                <form action="{{ route('admin.delete_product', $product->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z"/></svg>
                                    </button>
                                </form>
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

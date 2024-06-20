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
    <style>
        @font-face {
            font-family: "Josefin Sans";
            src: url("/fonts/josefin-sans/JosefinSans-regular.ttf") format('truetype');
        }

        @font-face {
            font-family: "Verdana";
            src: url("/fonts/verdana/verdana.ttf") format('truerype');
        }

        body {
            font-family: "Verdana";
        }
    </style>
</head>

<body>
    <div class="d-flex">
        @include('admin.sidebar')
        <!-- Sidebar -->
        {{-- <div class="sidebar">
            <h2 class="text-center">ADMIN</h2>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="nav-link" href="{{ route('admin.create_product') }}">Add Product</a>
                <a class="nav-link" href="{{ route('admin.orders') }}">Orders</a>
                <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
                <a class="nav-link" href="{{ route('admin.manage_products') }}">Produk</a>
            </nav>
        </div> --}}

        <!-- Main Content -->
        <div class="content">
            <div class="row">
                @php
                    use App\Models\User;
                    use App\Models\Product;
                    use App\Models\Order;
                    use App\Models\Review;
                    use App\Models\Kontak;
                    $totalUsers = User::count();
                    $products = Product::all();
                    $totalProduct = Product::count();
                    $totalOrders = Order::count();
                    $totalReviews = Review::count();
                    $totalKontak = Kontak::count();
                    $cards = [
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Produk',
                            'text' => 'Jumlah total produk yang tersedia di toko:' . $totalProduct . ' products',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Pesanan',
                            'text' => 'Jumlah total pesanan yang telah diterima: ' . $totalOrders . ' pesanan',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Ulasan',
                            'text' => 'Jumlah total ulasan produk yang diberikan oleh pelanggan: ' . $totalReviews . ' ulasan',
                        ],
                        // [
                        //     'color' => '#eebbc3',
                        //     'title' => 'Pendapatan Bulanan',
                        //     'text' => 'Total pendapatan yang diperoleh dalam bulan ini: Rp',
                        // ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Pengguna Terdaftar',
                            'text' => 'Jumlah total pengguna yang terdaftar di aplikasi: ' . $totalUsers . ' pengguna',
                        ],
                        [
                            'color' => '#eebbc3',
                            'title' => 'Total Kontak',
                            'text' => 'Jumlah total kontak yang masuk di aplikasi: ' . $totalKontak . ' kontak',
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

        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

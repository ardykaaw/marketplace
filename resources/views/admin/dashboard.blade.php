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
    <div class="d-flex flex-column">
        @include('admin.sidebar')

        <!-- Header Section -->
        <div class="header text-center mb-4">
            <h1>Dashboard Admin</h1>
            <p>Welcome to the admin dashboard. Here you can manage your store effectively.</p>
        </div>

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
                            'color' => '#007bff',
                            'title' => 'Total Produk',
                            'text' => 'Jumlah total produk yang tersedia di toko:' . $totalProduct . ' products',
                        ],
                        [
                            'color' => '#0056b3',
                            'title' => 'Total Pesanan',
                            'text' => 'Jumlah total pesanan yang telah diterima: ' . $totalOrders . ' pesanan',
                        ],
                        [
                            'color' => '#007bff',
                            'title' => 'Total Ulasan',
                            'text' => 'Jumlah total ulasan produk yang diberikan oleh pelanggan: ' . $totalReviews . ' ulasan',
                        ],
                        [
                            'color' => '#0056b3',
                            'title' => 'Pengguna Terdaftar',
                            'text' => 'Jumlah total pengguna yang terdaftar di aplikasi: ' . $totalUsers . ' pengguna',
                        ],
                        [
                            'color' => '#007bff',
                            'title' => 'Total Kontak',
                            'text' => 'Jumlah total kontak yang masuk di aplikasi: ' . $totalKontak . ' kontak',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-md-4 mb-3">
                        <div class="card text-white" style="background-color: {{ $card['color'] }};">
                            <div class="card-body d-flex align-items-center">
                                <i class="bi bi-box-fill me-2" style="font-size: 2rem;"></i>
                                <div>
                                    <h5 class="card-title">{{ $card['title'] }}</h5>
                                    <p class="card-text">{{ $card['text'] }}</p>
                                </div>
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .body {
            background-color: var(--thirty); /* Sesuai warna biru terang */
            font-family: Arial, sans-serif;
            margin: 0;
        }

       

        .content {
            margin-left: 270px; /* Adjust this value to match the sidebar width */
            padding: 20px;
        }

        .card-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        .card-item {
            display: flex;
            align-items: center;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 100%;
            max-width: 300px;
        }

        .card-item .icon-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 10px;
            margin-right: 15px;
        }

        .card-item .icon-wrapper i {
            font-size: 24px;
            color: #fff;
        }

        .card-item .text-wrapper {
            flex: 1;
            text-align: left;
        }

        .card-item .text-wrapper h5 {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .card-item .text-wrapper p {
            margin: 5px 0 0;
            font-size: 14px;
            color: #666;
        }
        :root {
            --primary: #007bff; /* Primary color */
            --bg-main: #ffffff; /* Sidebar background */
            --text-color: #343a40; /* Text color */
            --hover-color: #e9f5ff; /* Light blue hover */
        }

        body {
            font-family: "Verdana", sans-serif;
            background-color: #f5f5f5; /* Page background */
            margin: 0;
        }

        .sidebar {
            background-color: var(--bg-main);
            color: var(--text-color);
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: var(--text-color);
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar nav {
            flex-grow: 1;
        }

        .sidebar a {
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 16px;
            margin: 0 10px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: var(--hover-color);
            color: var(--primary);
        }

        .sidebar a.active {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
            padding: 18px 20px;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 20px;
        }

        .logout-btn {
            margin: 10px 10px 20px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 20px;
            width: calc(100% - 20px);
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }

        .logout-btn i {
            margin-right: 10px;
        }
    </style>
</head>

<body>
<div class="sidebar">
        <h2>Admin</h2>
        <nav>
            <a class="active" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i> Home
            </a>
            <a href="{{ route('admin.create_product') }}">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <a href="{{ route('admin.orders') }}">
                <i class="bi bi-box"></i> Pesanan
            </a>
            <a href="{{ route('admin.reviews') }}">
                <i class="bi bi-chat-dots"></i> Ulasan
            </a>
            <a href="{{ route('admin.manage_products') }}">
                <i class="bi bi-gear"></i> Kelola Produk
            </a>
        </nav>
        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="bi bi-arrow-left-circle"></i> Logout
        </a>
    </div><!-- Sidebar -->
   

    <!-- Main Content -->
    <div class="content">
        <div class="card-wrapper">
            @php
                use App\Models\User;
                use App\Models\Product;
                use App\Models\Order;
                use App\Models\Review;
                use App\Models\Kontak;

                $totalUsers = User::count();
                $totalProduct = Product::count();
                $totalOrders = Order::count();
                $totalReviews = Review::count();
                $totalKontak = Kontak::count();

                $cards = [
                    [
                        'icon' => 'fas fa-box',
                        'color' => 'bg-info',
                        'title' => 'Total Produk',
                        'text' => "Tersedia: $totalProduct"
                    ],
                    [
                        'icon' => 'fas fa-shopping-cart',
                        'color' => 'bg-success',
                        'title' => 'Total Pesanan',
                        'text' => "Diterima: $totalOrders"
                    ],
                    [
                        'icon' => 'fas fa-star',
                        'color' => 'bg-warning',
                        'title' => 'Total Ulasan',
                        'text' => "Diberikan: $totalReviews"
                    ],
                    [
                        'icon' => 'fas fa-users',
                        'color' => 'bg-danger',
                        'title' => 'Pengguna Terdaftar',
                        'text' => "Total: $totalUsers"
                    ],
                    [
                        'icon' => 'fas fa-envelope',
                        'color' => 'bg-secondary',
                        'title' => 'Kontak',
                        'text' => "Total: $totalKontak"
                    ],
                ];
            @endphp

            @foreach ($cards as $card)
                <div class="card-item">
                    <!-- Frame berwarna dengan ikon -->
                    <div class="icon-wrapper {{ $card['color'] }}">
                        <i class="{{ $card['icon'] }}"></i>
                    </div>
                    <!-- Teks di sebelah kanan -->
                    <div class="text-wrapper">
                        <h5>{{ $card['title'] }}</h5>
                        <p>{{ $card['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

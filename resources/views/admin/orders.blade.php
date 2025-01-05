<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-order.css') }}">
    <style>
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
<div class="d-flex">
<div>
        <!-- Sidebar -->
        <div class="sidebar">
        <h2>Admin</h2>
        <nav>
            <a class="" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i> Home
            </a>
            <a  href="{{ route('admin.create_product') }}">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <a class= 'active' href="{{ route('admin.orders') }}">
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
    </div>
    <!-- Main Content -->
    <div class="content container mt-5">
        <h1>Orders</h1>
        @if($orders->isEmpty())
            <p>{{ $message ?? 'Tidak ada data order.' }}</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Informasi Produk</th>
                        <th>Jumlah Pesanan</th>
                        <th>Alamat</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="orderTableBody">
                    @foreach($orders as $order)
                    <tr class="order-row">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name ?? 'User not found' }}</td>
                        <td>{{ $order->product->nama_product ?? 'Product not found' }}</td>
                        <td>{{ $order->product->category ?? 'Category not found' }}</td>
                        <td>
                            <p>Spesifikasi: {{ $order->product->spesifikasi ?? 'Spesifikasi not found' }}</p>
                            <p>Harga: Rp{{ number_format($order->product->harga ?? 0, 2) }}</p>
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->user->address }}</td>
                        <td>{{ $order->payment_method }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <a href="{{ route('admin.order_details', $order->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('admin.confirmOrder', $order->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Confirm</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <button id="showMoreBtn" class="btn btn-primary">Show More</button>
            </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll('.order-row');
        const showMoreBtn = document.getElementById('showMoreBtn');
        let visibleRows = 10;

        function updateVisibility() {
            rows.forEach((row, index) => {
                row.style.display = index < visibleRows ? '' : 'none';
            });
            showMoreBtn.style.display = visibleRows >= rows.length ? 'none' : 'inline-block';
        }

        showMoreBtn.addEventListener('click', function() {
            visibleRows += 10;
            updateVisibility();
        });

        updateVisibility();
    });
</script>
</body>
</html>

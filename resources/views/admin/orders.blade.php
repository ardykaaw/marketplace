<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-order.css') }}">
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
                        <th>Total Harga</th>
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
                        <td>Rp{{ number_format($order->total, 2) }}</td>
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

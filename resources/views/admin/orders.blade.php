<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    


<div class="container mt-5">
    <h1>Orders</h1>
    {{-- Periksa isi dari $orders --}}
    @if($orders->isEmpty())
        <p>{{ $message ?? 'Tidak ada data order.' }}</p>
    @else
        {{-- Tabel dan data order --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>jumlah Pesanan</th>
                    <th>Total Harga</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>
                        @if($order->user)
                            {{ $order->user->name }}
                        @else
                            User not found
                        @endif
                    </td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->product->harga }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i:s') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        <a href="{{ route('admin.order_details', $order->id) }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


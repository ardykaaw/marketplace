<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div>
        @include('navbar')
    </div>
    <div class="container mt-5 pt-5">
        <h1>Keranjang Belanja</h1>
        @php
            $carts = session('carts', collect());
        @endphp
        @if($carts->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->product->nama_product }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp {{ number_format($cart->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($cart->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Keranjang belanja Anda kosong.</p>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

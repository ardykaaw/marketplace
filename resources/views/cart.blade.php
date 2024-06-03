<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }
        html body {
            background-color: var(--bg-main);
            color: black;
        }
        .cart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }
        .cart-items {
            flex: 0 0 70%;
            background-color: var(--card);
            padding: 20px;
            border-radius: 5px;
        }
        .cart-summary {
            flex: 0 0 25%;
            background-color: var(--card);
            padding: 20px;
            border-radius: 5px;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .cart-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .cart-item-details {
            flex: 1;
            margin-left: 20px;
        }
        .cart-item-actions {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cart-summary h4, .cart-summary p {
            margin: 0;
        }
        .cart-summary .total {
            font-size: 1.5em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div>
        @include('navbar')
    </div>
    <div class="container cart-container">
        <div class="cart-items">
            <h1>Keranjang Belanja</h1>
            @if($cart && $cart->products->count() > 0)
                @foreach($cart->products as $product)
                    <div class="cart-item">
                        <img src="{{ asset($product->image_path ?? 'path/to/default/image.png') }}" alt="Product Image">
                        <div class="cart-item-details">
                            <h5>{{ $product->nama_product ?? 'Nama Produk Default' }}</h5>
                            <p>Rp{{ number_format($product->harga ?? 0) }}</p>
                            <p>Jumlah: {{ $product->pivot->quantity }}</p>
                            <p>Total: Rp{{ number_format(($product->harga ?? 0) * $product->pivot->quantity) }}</p>
                        </div>
                        <div class="cart-item-actions">
                            <button class="btn btn-danger">Remove</button>
                            <button class="btn btn-secondary">Edit</button>
                        </div>
                    </div>
                @endforeach
            @else
                <p>Keranjang belanja Anda kosong.</p>
            @endif
        </div>
        <div class="cart-summary">
            <h4>Summary</h4>
            <p>Subtotal: Rp{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</p>
            <p>Estimated Shipping & Handling: Rp0</p>
            <p>Tax: Rp0</p>
            <p class="total">Total: Rp{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</p>
            <button class="btn btn-primary btn-block">Checkout</button>
            <button class="btn btn-secondary btn-block">Check out with PayPal</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
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
            overflow: hidden;
        }
        .cart-container {
            display: flex;
            justify-content: space-between;
            margin-top: 100px; /* Turunkan sedikit semua card */
        }
        .cart-items {
            flex: 0 0 70%;
            background-color: var(--card);
            padding: 20px;
            border-radius: 5px;
            max-height: 500px; /* Set a max height for the scrollable area */
            overflow-y: auto; /* Enable vertical scrolling */
        }
        .cart-summary {
            flex: 0 0 25%;
            background-color: var(--card);
            padding: 20px;
            border-radius: 5px;
            position: relative;
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
        .checkout-button {
            position: absolute;
            bottom: 20px;
            width: 90%;
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->products as $product)
                            <tr id="product-row-{{ $product->id }}">
                                <td><img src="{{ asset($product->image_path ?? 'path/to/default/image.png') }}" alt="Product Image" width="100" height="100"></td>
                                <td>{{ $product->nama_product ?? 'Nama Produk Default' }}</td>
                                <td>Rp{{ number_format($product->harga ?? 0) }}</td>
                                <td>
                                    <button class="btn btn-secondary" onclick="updateQuantity({{ $product->id }}, -1, {{ $product->harga ?? 0 }})">-</button>
                                    <span id="quantity-{{ $product->id }}">{{ $product->pivot->quantity }}</span>
                                    <button class="btn btn-secondary" onclick="updateQuantity({{ $product->id }}, 1, {{ $product->harga ?? 0 }})">+</button>
                                </td>
                                <td id="total-{{ $product->id }}">Rp{{ number_format(($product->harga ?? 0) * $product->pivot->quantity) }}</td>
                                <td><button class="btn btn-danger" onclick="removeProduct({{ $product->id }})"><i class="fa fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Keranjang belanja Anda kosong.</p>
            @endif
        </div>
        <div class="cart-summary">
            <h4>Summary</h4>
            <p>Subtotal: Rp<span id="subtotal">{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</span></p>
            <p>Estimated Shipping & Handling: Rp0</p>
            <p>Tax: Rp0</p>
            <p class="total">Total: Rp<span id="total">{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</span></p>
            <button class="btn btn-primary btn-block checkout-button">Checkout</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function updateQuantity(productId, change, price) {
            console.log("Fungsi updateQuantity dipanggil dengan productId:", productId);
            let newQuantity = parseInt(document.getElementById('quantity-' + productId).innerText) + change;
            if (newQuantity >= 0) {
                $.ajax({
                    url: '/cart/update',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: newQuantity
                    },
                    success: function(response) {
                        document.getElementById('quantity-' + productId).innerText = newQuantity;
                        document.getElementById('total-' + productId).innerText = 'Rp' + newQuantity * price;
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            }
        }

        function removeProduct(productId) {
            $.ajax({
                url: '/cart/remove',
                type: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    document.getElementById('product-row-' + productId).remove();
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }
    </script>
</body>
</html>

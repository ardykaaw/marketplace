<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/cart.css')}}">
</head>
<body>
    <div>
        @include('navbar')
    </div>
    <div class="container cart-container">
        <div class="cart-items">
            <h1>Keranjang Belanja</h1>
            @if(isset($cart) && $cart->products->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart->products as $index => $product)
                            <tr id="product-row-{{ $product->id }}" data-product-id="{{ $product->id }}">
                                <td>{{ $index + 1 }}</td>
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
        @if(isset($cart))
        <div class="cart-summary">
            <h4>Summary</h4>
            <p>Jumlah Item: <span id="item-count">{{ $cart->products->sum('pivot.quantity') }}</span></p>
            <p>Subtotal: Rp<span id="subtotal">{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</span></p>
            <p class="total">Total: Rp<span id="total">{{ number_format($cart->products->sum(function($product) { return ($product->harga ?? 0) * $product->pivot->quantity; })) }}</span></p>
            <button class="btn btn-primary btn-block checkout-button" onclick="checkout()">Checkout</button>
        </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let alertShown = false;

        function updateQuantity(productId, change, price) {
            console.log("Fungsi updateQuantity dipanggil dengan productId:", productId);
            let newQuantity = parseInt(document.getElementById('quantity-' + productId).innerText) + change;
            if (newQuantity >= 0) {
                $.ajax({
                    url: '/cart/update',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: newQuantity,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        document.getElementById('quantity-' + productId).innerText = newQuantity;
                        document.getElementById('total-' + productId).innerText = 'Rp' + (newQuantity * price).toLocaleString();
                        updateSummary();
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
                    product_id: productId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    document.getElementById('product-row-' + productId).remove();
                    updateSummary();
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }

        function updateSummary() {
            let subtotal = 0;
            document.querySelectorAll('td[id^="total-"]').forEach(function(element) {
                subtotal += parseInt(element.innerText.replace('Rp', '').replace(/\./g, ''));
            });
            document.getElementById('subtotal').innerText = subtotal.toLocaleString();
            document.getElementById('total').innerText = subtotal.toLocaleString();
        }

        function checkout() {
            $.ajax({
                url: '{{ route('cart.checkout') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    payment_method: 'credit_card' // Contoh metode pembayaran
                },
                success: function(response) {
                    window.location.href = '{{ route("profile.riwayatPesanan") }}';
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        }

        $(document).ready(function() {
            $('#add-to-cart-button').off('click').on('click', function() { // Gunakan .off() untuk menghapus handler sebelumnya
                $(this).prop('disabled', true); // Nonaktifkan tombol saat permintaan sedang diproses

                $.ajax({
                    url: '/cart/add',
                    type: 'POST',
                    data: {
                        product_id: $(this).data('product-id'),
                        quantity: 1 // Misalkan selalu 1 untuk simplifikasi
                    },
                    success: function(response) {
                        alert(response.success);
                        $('#add-to-cart-button').prop('disabled', false); // Aktifkan kembali tombol setelah permintaan selesai
                    },
                    error: function() {
                        alert('Error adding product to cart');
                        $('#add-to-cart-button').prop('disabled', false); // Aktifkan kembali tombol jika terjadi error
                    }
                });
            });
        });
    </script>
</body>
</html>

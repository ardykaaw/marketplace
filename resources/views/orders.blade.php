<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <!-- Tambahkan CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        .raised {
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.19), 0px 6px 6px rgba(0, 0, 0, 0.23);
        }

        html body {
            background-color: var(--bg-main) !important;
            display: flex;
            justify-content: center;
            overflow-x: hidden;
        }

        .image-product-detail {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .cards {
            background-color: var(--primary);
            color: white;
            border-radius: 5px;
            border: 1px solid var(--thirty);
        }

        .image-product-detail img {
            width: 80%;
        }

        .buttonBuyNow button,
        .buttonAddCart button {
            background-color: var(--secondary);
            padding: 10px 20px;
            font-weight: bold;
            color: var(--primary);
        }

        .buttonExpression {
            display: flex;
            gap: 30px;
        }

        .circleRight,
        .circleLeft {
            position: absolute;
            width: 700px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            filter: blur(180px);
            -webkit-filter: blur(180px);
            bottom: -5px;
            z-index: -1;
        }

        .circleRight {
            background-color: rgba(184, 193, 236, 0.63);
            left: -170px;
        }

        .circleLeft {
            background-color: rgba(238, 187, 195, 0.63);
            right: -170px;
        }

        /* Animation styles */
        .success-animation {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 128, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 1000;
            animation: fadeInOut 3s forwards;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }

        .processing-animation {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 165, 0, 0.8);
            color: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 1000;
            animation: fadeInOut 3s forwards;
        }
    </style>
</head>

<body>
    <div>
        <div class="circleRight"></div>
        <div class="circleLeft"></div>
        @include('navbar')
        <div class="pt-5"></div>
        <div class="pt-3"></div>
        <div class="container pt-5 ">
            <div class=" mb-3 raised" style="max-width: 940px; margin: auto;">
                <div class="row g-0 cards">
                    <div class="col-md-4 image-product-detail">
                        <img src="{{ asset($product->image_path) }}" class="img-fluid rounded-start"
                            alt="{{ $product->nama_product }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title">{{ $product->nama_product }}</h2>
                            <p class="card-text lead">
                                Spesifikasi:
                                <br>
                                @php
                                    $specification = explode("\n", $product->spesifikasi);
                                @endphp

                                @foreach ($specification as $spec)
                                    {{ $spec }}<br>
                                @endforeach
                            </p>
                            <p class="card-text lead">Harga: {{ $product->harga }}</p>
                            <div class="buttonExpression">
                                <div class="buttonBuyNow">
                                    <button type="button" class="btn mt-3" style="background-color: #28a745; color: white;" data-toggle="modal" data-target="#paymentModal">Beli Sekarang</button>
                                </div>
                                <div class="buttonAddCart">
                                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn mt-3" style="background-color: #007bff; color: white;">Masukkan Keranjang</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Animation -->
        <div class="success-animation" id="cartSuccessMessage">Produk berhasil ditambahkan ke keranjang.</div>
        <div class="processing-animation" id="processingMessage">Pesanan Anda sedang diproses...</div>

        <!-- Modal -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content raised">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Pilih Metode Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('orders.store') }}" method="POST" id="paymentForm">
                            @csrf
                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <div class="d-flex flex-column">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-body text-center">
                                                <input class="form-check-input" type="radio" name="payment_method" id="bca" value="BCA" required>
                                                <label class="form-check-label" for="bca">
                                                    <img src="{{ asset('images/payments/bca.svg.png') }}" alt="BCA" style="width: 50px; height: auto;">
                                                    <h6>BCA</h6>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-body text-center">
                                                <input class="form-check-input" type="radio" name="payment_method" id="bri" value="BRI">
                                                <label class="form-check-label" for="bri">
                                                    <img src="{{ asset('images/payments/BRI.png') }}" alt="BRI" style="width: 50px; height: auto;">
                                                    <h6>BRI</h6>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mb-3">
                                            <div class="card-body text-center">
                                                <input class="form-check-input" type="radio" name="payment_method" id="bni" value="BNI">
                                                <label class="form-check-label" for="bni">
                                                    <img src="{{ asset('images/payments/logobni.svg.webp') }}" alt="BNI" style="width: 50px; height: auto;">
                                                    <h6>BNI</h6>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-link" id="showOtherMethods">Metode Lainnya</button>
                                <div id="otherMethods" style="display: none;">
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="card mb-3">
                                                <div class="card-body text-center">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="dana" value="Dana">
                                                    <label class="form-check-label" for="dana">
                                                        <img src="{{ asset('images/payments/DANA.png') }}" alt="Dana" style="width: 50px; height: auto;">
                                                        <h6>Dana</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card mb-3">
                                                <div class="card-body text-center">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="ovo" value="OVO">
                                                    <label class="form-check-label" for="ovo">
                                                        <img src="{{ asset('images/payments/OVO.svg.webp') }}" alt="OVO" style="width: 50px; height: auto;">
                                                        <h6>OVO</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card mb-3">
                                                <div class="card-body text-center">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="gopay" value="GoPay">
                                                    <label class="form-check-label" for="gopay">
                                                        <img src="{{ asset('images/payments/GOPAY.svg.png') }}" alt="GoPay" style="width: 50px; height: auto;">
                                                        <h6>GoPay</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card mb-3">
                                                <div class="card-body text-center">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="indomaret" value="Indomaret">
                                                    <label class="form-check-label" for="indomaret">
                                                        <img src="{{ asset('images/payments/INDOMARET.png') }}" alt="Indomaret" style="width: 50px; height: auto;">
                                                        <h6>Indomaret</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card mb-3">
                                                <div class="card-body text-center">
                                                    <input class="form-check-input" type="radio" name="payment_method" id="alfamart" value="Alfamart">
                                                    <label class="form-check-label" for="alfamart">
                                                        <img src="{{ asset('images/payments/ALFAMART.svg.png') }}" alt="Alfamart" style="width: 50px; height: auto;">
                                                        <h6>Alfamart</h6>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3" id="confirmPaymentButton">Konfirmasi Pembayaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan JS Bootstrap dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var productId = button.data('product-id');
                var modal = $(this);
                modal.find('.modal-body input[name="product_id"]').val(productId);
            });

            $('#payment_method').change(function() {
                var selectedMethod = $(this).val();
                var harga = {{ $product->harga }};
                var totalHarga = harga;
                var guide = '';

                if (selectedMethod === 'BCA') {
                    guide =
                        '<div class="card bg-light mb-3"><div class="card-header text-center"><h5 class="card-title">Panduan Pembayaran BCA</h5></div><div class="card-body"><p>Transfer ke rekening BCA 1234567890 a/n AUDIO.</p><p>Total yang harus dibayar: <strong>Rp ' +
                        totalHarga + '</strong></p></div></div>';
                } else if (selectedMethod === 'BRI') {
                    guide =
                        '<div class="card bg-light mb-3"><div class="card-header text-center"><h5 class="card-title">Panduan Pembayaran BRI</h5></div><div class="card-body"><p>Transfer ke rekening BRI 9876543210 a/n AUDIO.</p><p>Total yang harus dibayar: <strong>Rp ' +
                        totalHarga + '</strong></p></div></div>';
                } else if (selectedMethod === 'BNI') {
                    guide =
                        '<div class="card bg-light mb-3"><div class="card-header text-center"><h5 class="card-title">Panduan Pembayaran BNI</h5></div><div class="card-body"><p>Transfer ke rekening BNI 98477767454 a/n AUDIO.</p><p>Total yang harus dibayar: <strong>Rp ' +
                        totalHarga + '</strong></p></div></div>';
                }

                $('#payment-guide').html(guide);
            });

            $('#addToCartForm').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                var formData = {
                    product_id: $('input[name="product_id"]').val(),
                    quantity: 1,
                    _token: $('input[name="_token"]').val()
                };
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        $('#cartSuccessMessage').fadeIn().delay(3000).fadeOut(); // Show success animation
                        var cartCount = parseInt($('#cart-count').text()) || 0;
                        $('#cart-count').text(cartCount + 1);
                    }
                });
            });

            $('#paymentForm').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                var selectedPaymentMethod = $('input[name="payment_method"]:checked').val();

                if (!selectedPaymentMethod) {
                    alert('Silakan pilih metode pembayaran.');
                    return;
                }

                // Show processing animation
                $('#processingMessage').fadeIn();

                var formData = {
                    product_id: $('input[name="product_id"]').val(),
                    quantity: 1,
                    payment_method: selectedPaymentMethod,
                    _token: $('input[name="_token"]').val()
                };

                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#paymentModal').modal('hide'); // Close the payment modal
                            $('#processingMessage').delay(3000).fadeOut(); // Hide processing animation after delay
                        } else {
                            alert(response.error);
                        }
                    },
                    error: function(xhr) {
                        alert('Error confirming payment. Please try again.');
                        console.error('Error confirming payment:', xhr.responseText);
                    }
                });
            });
        });
    </script>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="mr-auto">Keranjang</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Produk berhasil ditambahkan ke keranjang.
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                var formData = {
                    product_id: $('input[name="product_id"]').val(),
                    quantity: 1,
                    payment_method: $('#payment_method').val(),
                    _token: $('input[name="_token"]').val()
                };
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: formData,
                    success: function(response) {
                        var cartCount = parseInt($('#cart-count').text()) || 0;
                        $('#cart-count').text(cartCount + 1);
                    }
                });
            });
        });
    </script>

    <script>
        document.getElementById('showOtherMethods').addEventListener('click', function() {
            var otherMethods = document.getElementById('otherMethods');
            if (otherMethods.style.display === 'none' || otherMethods.style.display === '') {
                otherMethods.style.display = 'block';
            } else {
                otherMethods.style.display = 'none';
            }
        });
    </script>
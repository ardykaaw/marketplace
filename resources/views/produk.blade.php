<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #1a1a2e;
            color: #fff;
            font-family: 'Inter', sans-serif;
        }
        .card-hover:hover {
            transform: translateY(-10px);
            transition: transform 0.3s;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        .card-img-top {
            height: 250px;
            width: 100%;
            object-fit: contain;
            padding: 20px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }
        html {
            scroll-behavior: smooth;
        }
        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .content {
            display: none;
        }
        .filter-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .filter-select {
            width: 50%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .card {
            background-color: #34495e;
            border: none;
            border-radius: 5px;
            overflow: hidden;
            position: relative;
            padding: 20px;
            height: 450px;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 0.5s ease-out forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-title, .card-text, .btn {
            color: #ecf0f1;
        }
        .btn {
            background-color: #3498db;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn:hover {
            background-color: #2980b9;
        }
        .category-title {
            text-align: center;
            margin: 40px 0 20px;
            font-size: 1.5rem;
            color: #3498db;
        }
    </style>
</head>
<body style="background-color: #1a1a2e; color: #fff; font-family: 'Inter', sans-serif;">
    <div class="loader" id="loader"></div>
    <div class="content" id="content">
        @include('navbar')
        <div class="container mt-5 pt-5">
            <div class="filter-container">
                <select id="productFilter" class="filter-select">
                    <option value="all">Semua Produk</option>
                    <option value="headphone">Headphones</option>
                    <option value="earphones">Earphones</option>
                    <option value="speaker">Speaker</option>
                </select>
            </div>
            <h1 class="display-4 text-center">Temukan Koleksi Terbaik Kami!</h1>
            <p class="lead text-center">Dari kebutuhan sehari-hari hingga barang mewah, semua produk kami dirancang untuk memberikan kualitas dan nilai terbaik. Siap-siap terpukau!</p>
            <div class="row">
                @foreach(['headphone', 'earphone', 'speaker'] as $category)
                    <div class="category-title pt-5">{{ strtoupper($category) }}</div>
                    @foreach($products->where('category', $category) as $product)
                        <div class="col-md-4 d-flex align-items-stretch pt-5 shadow-sm card-hover">
                            <div class="card" style="width: 100%; background-color: #1a1a2e; padding: 20px; border-radius: 10px; border: 2px solid #ffffff;">
                                <img src="{{ asset($product->image_path) }}" class="card-img-top" alt="{{ $product->nama_product }}">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff">{{ $product->nama_product }}</h5>
                                    <p class="card-text" style="color:#fff">Rp.{{ number_format($product->harga) }}</p>
                                    <a href="{{ route('orders', $product->id) }}" class="btn btn-primary mt-auto">Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="pt-5">
            @include('footer')
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loader = document.getElementById('loader');
            const content = document.getElementById('content');

            // Menampilkan loader
            loader.style.display = 'block';
            content.style.display = 'none';

            window.onload = function() {
                // Menyembunyikan loader dan menampilkan konten setelah halaman dimuat
                loader.style.display = 'none';
                content.style.display = 'block';
            };
        });

        document.getElementById('productFilter').addEventListener('change', function() {
            var selectedType = this.value;
            window.location.href = `?type=${selectedType}`;
        });
    </script>
</body>
</html>

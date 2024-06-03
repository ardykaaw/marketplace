<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #1a1a2e;
            color: #fff;
            font-family: 'Inter', sans-serif;
        }

        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            transition: transform 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .content {
            display: none;
            margin-bottom: 100px;
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

        .card-title,
        .card-text,
        .btn {
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
        <div class="navbar">
            <style>
                body,
                html {
                    font-family: 'Roboto', sans-serif;
                    margin: 0;
                    padding: 0;
                    width: 100%;
                    height: 100%;
                }

                .navbar {
                    transition: top 0.3s, background-color 0.3s;
                    /* background-color: rgba(18, 22, 41, 0.9); */
                    padding: 20px 100px
                }

                .navbar .navbar-nav .nav-link {
                    color: #fff;
                    font-size: 1.1rem;
                    transition: color 0.3s;
                }

                .navbar .navbar-nav .nav-link:hover,
                .navbar .navbar-nav .nav-link:focus {
                    color: #f0f0f0;
                }

                .navbar .navbar-nav .nav-link.active {
                    color: #fff;
                    font-weight: bold;
                }

                .navbar-toggler-icon {
                    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
                }

                .navbar-brand {
                    font-weight: bold;
                }

                .navbar-nav .nav-item {
                    margin-left: 20px;
                }

                .navbar-nav .nav-item .bi {
                    font-size: 1.5rem;
                }

                .search-bar {
                    display: flex;
                    align-items: center;
                    margin-right: 0;
                    margin-left: auto;
                }

                .search-bar input {
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    font-size: 1rem;
                }

                .search-bar button {
                    margin-left: 10px;
                    padding: 5px 10px;
                    border-radius: 5px;
                    border: none;
                    background-color: #3498db;
                    color: #fff;
                    font-size: 1rem;
                }

                .search-bar button:hover {
                    background-color: #2980b9;

                }
            </style>
            </head>

            <body>
                <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Audio</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('produk') }}">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home') }}">Contact Us</a>
                                </li>
                            </ul>

                            <ul class="navbar-nav ms-auto">
                                <div class="search-bar">
                                    <form action="{{ route('produk') }}" method="GET">
                                        <input type="text" name="search" placeholder="Search..."
                                            value="{{ request('search') }}">
                                        <button type="submit">Search</button>
                                    </form>
                                </div>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart') }}"><i class="bi bi-cart"></i></a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile"
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-person-circle"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                                        <li><a class="dropdown-item" href="{{ route('profile.view') }}">View Profile</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
                </script>
                <script>
                    let lastScrollTop = 0;
                    window.addEventListener("scroll", function() {
                        let st = window.pageYOffset or document.documentElement.scrollTop;
                        if (st > lastScrollTop) {
                            document.querySelector('.navbar').style.top = "-100px";
                        } else {
                            document.querySelector('.navbar').style.top = "0";
                        }
                        lastScrollTop = st <= 0 ? 0 : st;
                    }, false);
                </script>
        </div>
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
            <p class="lead text-center">Dari kebutuhan sehari-hari hingga barang mewah, semua produk kami dirancang
                untuk memberikan kualitas dan nilai terbaik. Siap-siap terpukau!</p>
            <div class="row">
                @foreach (['headphone', 'earphone', 'speaker'] as $category)
                    <div class="category-title pt-5">{{ strtoupper($category) }}</div>
                    @foreach ($products->where('category', $category) as $product)
                        <div class="col-md-4 d-flex align-items-stretch pt-5 shadow-sm card-hover">
                            <div class="card"
                                style="width: 100%; background-color: #232946; padding: 20px; border-radius: 10px; border: 2px solid #ffffff;">
                                <img src="{{ asset($product->image_path) }}" class="card-img-top"
                                    alt="{{ $product->nama_product }}">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff">{{ $product->nama_product }}</h5>
                                    <p class="card-text" style="color:#fff">Rp.{{ number_format($product->harga) }}</p>
                                    <a href="{{ route('orders', $product->id) }}"
                                        class="btn btn-primary mt-auto">Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
        <div class="footer">
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

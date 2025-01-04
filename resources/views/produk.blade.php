<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/produk.css') }}">
</head>

<body style="background-color: #1a1a2e; color: #fff; font-family: 'Inter', sans-serif;">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Audio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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

                <ul class="navbar-nav ms-auto" style="align-items: center">
                    <div class="search-bar">
                        <form action="{{ route('produk') }}" method="GET">
                            <div class="search">
                                <div class="search-box">
                                    <div class="search-field">
                                        <input type="text" class="input" name="search" placeholder="Search..."
                                            value="{{ request('search') }}">
                                        <div class="search-box-icon">
                                            <button class="btn-icon-content">
                                                <i class="search-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                        viewBox="0 0 512 512">
                                                        <path
                                                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"
                                                            fill="#fff"></path>
                                                    </svg>
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="{{ route('cart') }}"><i class="bi bi-cart"></i></a>
                        <span class="position-absolute bottom-50 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                            {{-- <span class="visually-hidden">unread messages</span> --}}
                        </span>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
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
    <div class="content" id="content">
        {{-- scrip js --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
        </script>
        <script>
            let lastScrollTop = 0;
            window.addEventListener("scroll", function() {
                let st = window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    document.querySelector('.navbar').style.top = "-100px";
                } else {
                    document.querySelector('.navbar').style.top = "0";
                }
                lastScrollTop = st <= 0 ? 0 : st;
            }, false);
        </script>
        <div class="container mt-5 pt-5">
            <div class="filter-container">
                <select id="productFilter" class="filter-select">
                    <option value="all">Semua Produk</option>
                    <option value="headphone" {{ request('category') == 'headphone' ? 'selected' : '' }}>Headphones
                    </option>
                    <option value="earphone" {{ request('category') == 'earphone' ? 'selected' : '' }}>Earphones
                    </option>
                    <option value="speaker"{{ request('category') == 'speaker' ? 'selected' : '' }}>Speaker</option>
                </select>
            </div>
            <h3 class="text-center">Temukan Koleksi Terbaik Kami!</h3>
            <p class="text-center px-96">Dari kebutuhan sehari-hari hingga barang mewah, semua produk kami dirancang
                untuk memberikan kualitas dan nilai terbaik. Siap-siap terpukau!</p>
            <div class="row" style="padding: 0 70px 80px 70px">
                @foreach (['headphone', 'earphone', 'speaker'] as $category)
                    <div class="categorys-title">{{ strtoupper($category) }}</div>
                    @foreach ($products->where('category', $category) as $product)
                        <div class="col-md-4 d-flex align-items-stretch pt-5 shadow-sm card-hover">
                            <div class="card flex justify-center">
                                <img src="{{ asset($product->image_path) }}" class="card-img-top"
                                    alt="{{ $product->nama_product }}">
                                <div class="card-body">
                                    <h5 class="card-title" style="color: #fff">{{ $product->nama_product }}</h5>
                                    <p class="card-text" style="color:#fff">
                                        Rp.{{ number_format($product->harga) }}
                                    </p>
                                    <a href="{{ route('orders', $product->id) }}" class="btn mt-auto" style="background-color: #007bff; color: #fff;">Details</a>
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
        document.getElementById('productFilter').addEventListener('change', function() {
            var category = this.value;
            // alert(category)
            window.location.href = `?category=${category}`;
        });
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>

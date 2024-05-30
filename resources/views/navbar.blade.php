<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nama Aplikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        :root {
            --primary: #232946;
            --secondary: #eebbc3;
            --thirty: #b8c1ec;
            --bg-main: #121629;
            --card: #fffffe;
        }

        .navbar {
            transition: top 0.3s, background-color 0.3s;
            padding: 10px 100px;
        }

        .navbar.scrolled {
            background: var(--bg-main 0.5);
            border-bottom: 1px solid var(--thirty);
            backdrop-filter: blur(40px);
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
    </style>
</head>

<body>
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
                        <a class="nav-link" href="#contact">Contact Us</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}"><i class="bi bi-cart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownProfile">
                            <li><a class="dropdown-item" href="{{ route('profile.view') }}">View Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a></li>
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
    <script src="{{ asset('js/script.js') }}"></script>
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
</body>

</html>

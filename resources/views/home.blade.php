<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
    <style>
        /* #particleCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;   
            z-index: 1;
        } */
    </style>
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
    <div class="loader" id="loader"></div>
    {{-- loader --}}
    {{-- <div class="three-body">
        <div class="three-body__dot"></div>
        <div class="three-body__dot"></div>
        <div class="three-body__dot"></div>
        </div> --}}
    <div class="content" id="content">
        {{-- @include('navbar') --}}
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
                        <li class="nav-item position-relativ">
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
        <div class="banner">
            <div class="circle2"></div>
            <div class="circle3"></div>
            <div class="circle"></div>
            <div class="banner-content">
                <h1>Mendengarkan Musik Bersama Produk Terbaik Kami</h1>
                <p>Dengarkan musik dengan lebih nyaman bersama produk terbaik kami. Kami selalu menyediakan produk yang
                    terbaik dan berkualitas.</p>
                <div class="banner-images d-flex justify-content-start">
                    <div class="card"
                        style="width: 100px; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('images/headphone/headphone-9.png') }}" class="card-img-top" alt="Product 1"
                            style="height: 90px; object-fit: contain;">
                    </div>
                    <div class="card"
                        style="width: 100px; display: flex; justify-content: center; align-items: center">
                        <img src="{{ asset('images/headphone/headphone-8.png') }}" class="card-img-top" alt="Product 2"
                            style="height: 90px; object-fit: contain;">
                    </div>
                    <div class="card"
                        style="width: 100px; display: flex; justify-content: center; align-items: center;">
                        <img src="{{ asset('images/headphone/headphone-6.png') }}" class="card-img-top" alt="Product 3"
                            style="height: 90px; object-fit: contain;">
                    </div>
                </div><a href="{{ route('produk') }}" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff; position: relative; z-index: 1;" role="button">Buy Now</a>
            </div>
            <div class="image-home">
                <div class="banner-image">
                    <img src="{{ asset('images/headphone/headphone-9.png') }}" alt="Large Headphone">
                </div>
                <div class="reflectionImg">
                    <img src="{{ asset('images/headphone/headphone-9.png') }}" alt="Large Headphone">
                </div>
            </div>

        </div>

        <div class="special-collection">
            <h3 style="font-family: 'inter', sans-serif;">Special Collection</h3>
            <h3>Our Top Products in This Session</h3>
            <div class="row row-cols-1 row-cols-md-3 g-5">
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <div class="image-special-collection">
                            <img src="{{ asset('images/headphone/headphone-8.png') }}" class="card-img-top"
                                alt="SonicWave Elite">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">SonicWave Elite
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <div class="image-special-collection">
                            <img src="{{ asset('images/earphones/earphone-4.png') }}" class="card-img-top"
                                alt="SonicPro X1">
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">
                                SonicPro X1</h5>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <div class="image-special-collection">
                            <img src="{{ asset('images/speaker/speaker-3.png') }}" class="card-img-top"
                                alt="AcousticFlow Pro">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">AcousticFlow Pro</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="enjoy-music" style="padding: 0 100px;">
            <div class="content">
                <h2 style="color: #007bff;">Enjoy Your Music Everywhere You Want</h2>
                <p>Nikmati kenyamanan belanja produk audio terbaik dengan harga terjangkau. Temukan berbagai pilihan
                    headphone, earphone, dan speaker yang akan meningkatkan pengalaman mendengarkan musik Anda setiap
                    hari.</p>
            </div>
            <div class="circleMusic"></div>
            <div class="image py-5">
                <img src="{{ asset('images/iklan.png') }}" alt="Person Listening to Music">
            </div>
        </div>
        {{-- paralax START --}}
        <div class="paralax">
            <div class="contentParalax">
                <h1>Audio</h1>
            </div>
        </div>
        {{-- paralax END --}}
        <div class="testimonials-section"
            style="color: #fff; font-family: 'Arial', sans-serif; display: flex; justify-content: center; align-items: center; height: 50vh; margin: 0;">
            <div class="testimonial-container" style="text-align: center;">
                <h2 class="testimonial-header" style="color: #007bff;"; font-size: 1.5rem; margin-bottom: 20px;">OUR
                    CUSTOMERS REVIEW</h2>
                <div class="testimonial-card"
                    style="background-color: #1a1a2e; padding: 20px; border-radius: 10px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23); display: flex; align-items: center; justify-content: center; max-width: 600px; margin: 0 auto;">
                    <div class="testimonial-image"
                        style="width: 80px; height: 80px; background-image: url('{{ asset('images/iklan.jpg') }}'); background-size: cover; border-radius: 50%; margin-right: 20px;">
                    </div>
                    <div class="testimonial-content" style="text-align: left;">
                        <p class="testimonial-text" style="font-size: 1rem; margin-bottom: 10px;">Produknya
                            berkualitas
                            sesuai dengan spesifikasi yang tertera di product</p>
                        <div class="testimonial-stars" style="color: #ffd700;">
                            &#9733; &#9733; &#9733; &#9733; &#9733;
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="contact">
            @include('kontak')
        </div>

        <footer class="footer pt-5" style="z-index: -1">
            @include('footer')
        </footer>
    </div>
    {{-- <div class="cursor-ball" id="cursorBall"></div>
    <canvas id="particleCanvas"></canvas> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
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

        document.addEventListener('DOMContentLoaded', function() {
            const ball = document.getElementById('cursorBall');
            let mouseX = 0;
            let mouseY = 0;
            let ballX = 0;
            let ballY = 0;
            let speed = 0.1; // Kecepatan bola mengikuti cursor

            document.addEventListener('mousemove', function(e) {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });

            function animate() {
                let distX = mouseX - ballX;
                let distY = mouseY - ballY;
                ballX = ballX + distX * speed;
                ballY = ballY + distY * speed;

                ball.style.left = ballX + 'px';
                ball.style.top = ballY + 'px';

                requestAnimationFrame(animate);
            }

            animate();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('particleCanvas');
            const ctx = canvas.getContext('2d');
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            let particlesArray = [];

            class Particle {
                constructor(x, y) {
                    this.x = x;
                    this.y = y;
                    this.size = Math.random() * 5 + 1;
                    this.speedX = Math.random() * 5 - 2.5; // Increase speed range for more dispersion
                    this.speedY = Math.random() * 5 - 2.5; // Increase speed range for more dispersion
                    this.color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 0.8)`;
                }

                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;
                    if (this.size > 0.2) this.size -= 0.1;
                }

                draw() {
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            const handleParticles = () => {
                for (let i = 0; i < particlesArray.length; i++) {
                    particlesArray[i].update();
                    particlesArray[i].draw();
                    if (particlesArray[i].size <= 0.3) {
                        particlesArray.splice(i, 1);
                        i--;
                    }
                }
            };

            window.addEventListener('mousemove', function(e) {
                for (let i = 0; i < 10; i++) { // Increase the number of particles generated
                    particlesArray.push(new Particle(e.pageX, e.pageY));
                }
            });

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                handleParticles();
                requestAnimationFrame(animate);
            }

            animate();
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css') }}">
</head>

<body>
    <div class="loader" id="loader"></div>
    <div class="content" id="content">
        @include('navbar')
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
                </div><a href="{{ route('produk') }}" class="btn btn-primary">Buy Now</a>
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
                <h2>Enjoy Your Music Everywhere You Want</h2>
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
                <h2 class="testimonial-header" style="color: #f8c8dc; font-size: 1.5rem; margin-bottom: 20px;">OUR
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
    <div class="cursor-ball" id="cursorBall"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
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
    </script>
</body>

</html>

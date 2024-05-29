<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        * {
            margin: 0;
            padding: 0;
            /* background-color: var(--bg-main); */
        }

        ::selection {
            background: var(--secondary);
        }

        body {
            color: #fff;
            font-family: 'Inter', sans-serif;
        }

        .banner {
            background: var(--bg-main);
            height: 100vh;
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            color: white;
            padding: 0 100px;
            overflow: hidden;
            position: relative;
            z-index: -2;
        }

        .banner-content {
            /* max-width: 50%; */
        }

        .banner-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .banner-content p {
            font-size: 1.3rem;
            font-weight: 100;
            margin-bottom: 20px;
        }

        .banner-content .btn {
            font-size: 1.2rem;
            padding: 10px 20px;
            background-color: var(--secondary);
            border: none;
        }

        .banner-images {
            display: flex;
            justify-content: flex-end;
            gap: 20px;
            margin-bottom: 20px;
        }

        .banner-images .card {
            background: var(--bg-main);
            padding: 0 30px;
        }

        .banner-images img {
            width: 60px;
            height: 60px;
        }

        .banner-image img {
            max-width: 80%;
            height: auto;
            animation: sideFade 1.5s ease-in-out;
            margin-top: -100px;
        }

        .banner-image .reflectionImg {
            position: absolute;
            max-width: 53%;
            height: auto;
            right: 245px;
            transform: rotate(180deg);
            z-index: -2;
            /* animation: sideFade 1.5s ease-in-out; */
        }

        @keyframes sideFade {
            0% {
                opacity: 0;
                transform: translateX(50%);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .feature-box {
            margin-top: 50px;
        }

        .feature-box i {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .product-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            padding: 0 50px;
        }
        .product-card .image-special-collection {
            padding: 20px;
        }
        .product-card .card-body {
            padding: 0;
        }

        .product-card .card-body .card-title {
            text-align: end;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .rating .bi-star-fill {
            color: #ffd700;
        }

        .footer {
            /* background-color: #0f3460; */
            padding: 20px;
            text-align: center;
        }

        .cursor-ball {
            position: fixed;
            width: 20px;
            height: 20px;
            background-color: var(--secondary);
            border-radius: 50%;
            pointer-events: none;
            transform: translate(-50%, -50%);
            z-index: 10000;
            transition: transform 0.1s linear;
        }

        .special-collection {
            background-color: var(--bg-main);
            padding: 50px 100px;
            text-align: center;
        }

        .special-collection h2 {
            color: var(--secondary);
            margin-bottom: 30px;
        }

        .special-collection .product-card {
            background-color: #1a1a2e;
            border: none;
        }

        .enjoy-music {
            background-color: var(--bg-main);
            padding: 50px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .enjoy-music .content {
            max-width: 50%;
        }

        .enjoy-music .content h2 {
            color: var(--secondary);
            margin-bottom: 20px;
        }

        .enjoy-music .content p {
            color: #fff;
        }

        .enjoy-music .image {
            max-width: 40%;
        }

        .enjoy-music .image img {
            width: 100%;
            border-radius: 10px;
        }

        .circle2 {
            position: absolute;
            right: 10%;
            width: 800px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(184, 193, 236, 0.63);
            filter: blur(180px);
            -webkit-filter: blur(180px);
            z-index: -1;
        }

        .circle3 {
            position: absolute;
            top: -50px;
            left: -5%;
            width: 350px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(238, 187, 195, 0.63);
            filter: blur(140px);
            -webkit-filter: blur(140px);
            opacity: 50%;
        }

        .circle {
            position: absolute;
            bottom: -50px;
            left: -5%;
            width: 350px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(238, 187, 195, 0.63);
            filter: blur(140px);
            -webkit-filter: blur(140px);
            opacity: 50%;
        }

        .testimonials-section {
            background-color: var(--bg-main)
        }
    </style>
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
            <div class="banner-image">
                <img src="{{ asset('images/headphone/headphone-9.png') }}" alt="Large Headphone">
                <div class="reflectionImg">
                    <img src="{{ asset('images/headphone/headphone-9.png') }}" alt="Large Headphone">
                </div>
            </div>
        </div>

        <div class="special-collection">
            <h2 style="font-family: 'inter', sans-serif;">Special Collection</h2>
            <p>Our Top Products in This Session</p>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <div class="image-special-collection">
                            <img src="{{ asset('images/headphone/headphone-8.png') }}" class="card-img-top"
                                alt="SonicWave Elite">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; position:absolute; right: 70px;">SonicWave Elite</h5>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <img src="{{ asset('images/earphones/earphone-4.png') }}" class="card-img-top"
                            alt="SonicPro X1">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white; position: absolute; bottom: -1px; left: 90px;">SonicPro X1</h5>
                        </div>
                    </div>
                </div>
                <div class="col d-flex justify-content-center">
                    <div class="card product-card" style="width: 18rem; position: relative;">
                        <span class="badge bg-success" style="position: absolute; top: 10px; right: 10px;">New</span>
                        <img src="{{ asset('images/speaker/speaker-3.png') }}" class="card-img-top"
                            alt="AcousticFlow Pro">
                        <div class="card-body">
                            <h5 class="card-title" style="color: white">AcousticFlow Pro</h5>
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
            <div class="image py-5">
                <img src="{{ asset('images/iklan.png') }}" alt="Person Listening to Music">
            </div>
        </div>
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
                        <p class="testimonial-text" style="font-size: 1rem; margin-bottom: 10px;">Produknya berkualitas
                            sesuai dengan spesifikasi yang tertera di product</p>
                        <div class="testimonial-stars" style="color: #ffd700;">
                            &#9733; &#9733; &#9733; &#9733; &#9733;
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer pt-5">
            @include('footer')
        </footer>
    </div>
    <div class="cursor-ball" id="cursorBall"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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

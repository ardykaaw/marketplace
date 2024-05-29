<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bagian Footer</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
         :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
         }
        .footer {
            background-color: var(--bg-main);
            color: white;
            padding: 20px 0;
            position: relative;
            width: 100%;
            left: 0;
            right: 0;
        }
        .footer img {
            position: absolute;
            bottom: 0;
            left: 0;
            width: auto;
            height: auto;
            z-index: 1;
        }
        .circle4 {
            position: absolute;
            top: -50px;
            right: 10%;
            width: 500px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(184, 193, 236, 0.63);
            filter: blur(140px);
            -webkit-filter: blur(140px);
            opacity: 50%;
            z-index: 1;

        }

        .circle5 {
            position: absolute;
            top: -50px;
            left: 10%;
            width: 500px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: var(--secondary);
            filter: blur(140px);
            -webkit-filter: blur(140px);
            opacity: 50%;
            z-index: 1;
        }

        .footer-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
    <div class="circle4"></div>
    <div class="circle5"></div>
    <footer class="footer text-center">
        <img src="{{asset('images\tanggaNada1 1 (1).png')}}" alt="Music Notes">
        <div class="container footer-content">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="text-uppercase">AUDIO</h5>
                    <p>Lorem Ipsum, Dolor Sit Amet Consectetur Adipisicing Elit</p>
                </div>
                <div class="col-md-4 mb-4">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">Products</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Instagram</a></li>
                        <li><a href="#" class="text-white">X</a></li>
                        <li><a href="#" class="text-white">Facebook</a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <p>+123-456-7890</p>
                    <p>audio@gmail.com</p>
                    <p>Jln.Jalanin Aja Dulu, 123</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>Tim Kelompok 3</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
</html>
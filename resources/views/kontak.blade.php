<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1f1c2c, #928dab);
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }
        .container {
            background: #2c2c54;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-label {
            font-weight: bold;
            color: #fff;
        }
        .btn-primary {
            background-color: #ff6b6b;
            border: none;
        }
        .btn-primary:hover {
            background-color: #ff4757;
        }
        .card {
            background-color: #2c2c54;
            color: white;
        }
        .card .btn-secondary {
            background-color: #ff6b6b;
            border: none;
        }
        .card .btn-secondary:hover {
            background-color: #ff4757;
        }
        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #3498db;
            animation: spin 1s linear infinite;
            transform: translate(-50%, -50%);
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .content {
            display: none;
        }
        .contact-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #ff6b6b;
        }
        .btn {
            background-color: #ff6b6b;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
        }
        .btn:hover {
            background-color: #ff4757;
        }
    </style>
</head>
<body>
    <div class="loader" id="loader"></div>
    <div class="content" id="content">
        @include('navbar')

        <div class="container mt-5 pt-5">
            <h2 class="contact-title">CONTACT US</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ url('/submit-kontak') }}" method="post">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Username</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <label for="password" the form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <label for="pesan" class="form-label">Message</label>
                            <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="card mt-4">
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.938091234567!2d122.4970253147806!3d-4.0033052970000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d98efb1b1b1b1b1%3A0x1b1b1b1b1b1b1b1b!2sMasjid%20Al-Alam!5e0!3m2!1sen!2sid!4v1634567890123!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('footer')
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
    </script>
</body>
</html>


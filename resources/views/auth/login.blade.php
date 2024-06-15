<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        body {
            background: rgba(18, 22, 41, 1);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            padding: 20px;
            width: 100%;
            max-width: 700px;
            /* Lebar card diperbesar dari 400px menjadi 500px */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1.5px solid var(--thirty);
        }

        .form-label {
            color: #fff;
        }

        .form-control {
            background: transparent;
            border: none;
            border-bottom: 1px solid #fff;
            border-radius: 0;
            color: #fff;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #fff;
        }

        .btn-primary {
            background: rgba(255, 255, 255, 0.3);
            border: none;
            width: 100%;
            padding: 10px;
            color: #fff;
        }

        .btn-primary:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        .card-header,
        .card-body,
        .mt-3 p {
            color: #fff;
        }

        .mt-3 a {
            color: #fff;
            text-decoration: underline;
        }

        .circle {
            position: absolute;
            top: -5%;
            left: -5%;
            width: 600px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(238, 187, 195, 0.63);
            filter: blur(200px);
            -webkit-filter: blur(200px);
        }

        .circle2 {
            position: absolute;
            bottom: -5%;
            right: -5%;
            width: 600px;
            aspect-ratio: 1/1;
            border-radius: 100%;
            background: rgba(184, 193, 236, 0.63);
            filter: blur(180px);
            -webkit-filter: blur(180px);
        }
    </style>
</head>

<body>
    <div class="circle"></div>
    <div class="circle2"></div>
    <div class="card">

        <div class="card-header text-center">
            <h2>Sign In</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Username</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign In</button>
            </form>
            <div class="mt-3 text-center">
                <p>You don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
                <p><a href="{{ route('password.request') }}">Forgot Your Password?</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

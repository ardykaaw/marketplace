<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #007bff;
            --bg-main: url('images/loginbg.jpg');
            --card: rgba(255, 255, 255, 0.9);
        }

        body {
            background: var(--bg-main);
            background-size: cover; /* Ensures the background image covers the entire body */
            background-position: center; /* Centers the background image */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
        }

        .card {
            background: var(--card);
            border: none;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            color: #333;
        }

        .form-control {
            background: transparent;
            border: 1px solid #007bff;
            border-radius: 5px;
            color: #333;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0056b3;
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            width: 100%;
            padding: 10px;
            color: #fff;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        .card-header,
        .card-body,
        .mt-3 p {
            color: #333;
        }

        .mt-3 a {
            color: var(--primary);
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header text-center">
            <h2>Sign In</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
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

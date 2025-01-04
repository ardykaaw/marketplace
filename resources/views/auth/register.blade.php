    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            :root {
                --primary: #007bff; /* Updated to match auth.login */
                --bg-main: url('images/loginbg.jpg'); /* Background image from auth.login */
                --card: rgba(255, 255, 255, 0.9); /* Updated to match auth.login */
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
                overflow: hidden;
            }

            .card {
                background: var(--card);
                border: none;
                border-radius: 10px;
                padding: 20px;
                width: 100%;
                max-width: 700px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border: 1.5px solid var(--primary);
            }

            .form-label {
                color: #333;
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
                background: rgba(0, 123, 255, 0.3); /* Updated to match auth.login */
                border: none;
                width: 100%;
                padding: 10px;
                color: #fff;
            }

            .btn-primary:hover {
                background: rgba(0, 123, 255, 0.5); /* Updated to match auth.login */
            }

            .card-header,
            .card-body {
                color: #333;
            }
        </style>

    </head>

    <body>
        <div class="card">
            <div class="card-header text-center">
                <h2>Register</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>

                    <div class="mb-0">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Bootstrap JS dan Popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

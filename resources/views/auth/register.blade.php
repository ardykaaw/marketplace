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
                --primary: #B8C1EC;
                --secondary: #EEBBC3;
                --thirty: #B8C1EC;

                --bg-color: #121629;
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
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border: 1.5px solid var(--primary);
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
            .card-body {
                color: #fff;
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

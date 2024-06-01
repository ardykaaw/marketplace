<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        body {
            background: var(--bg-main);
            color: #fff;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            padding: 0 100px;
        }

        .card {
            color: white;
        }

        .btn {
            background-color: var(--secondary);
            border: none;
            border-radius: 5px;
            padding: 8px 30px;
        }
    </style>
</head>
<body>
    <div class="contentContact pt-5" id="content">
        <div class="container mt-5 pt-5">
            <h2 class="contact-title">Edit Profil Pengguna</h2>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ optional(Auth::user())->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ optional(Auth::user())->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ optional(Auth::user())->address }}" placeholder="Tambahkan alamat" required>
                        </div>
                        <div class="buttonContactUs">
                            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

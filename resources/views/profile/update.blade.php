<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
</head>
<body>
<div> 
    @include('navbar')
</div>
<div class="container mt-5 pt-5">
    <h2 class="mb-4">Update Profil Pengguna</h2>
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
                <button type="submit" class="btn btn-primary">Perbarui Profil</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>

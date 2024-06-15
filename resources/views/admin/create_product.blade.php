<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-create.css') }}">
</head>
<body>
<div>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2 class="text-center">ADMIN</h2>
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('admin.create_product') }}">Add Product</a>
            <a class="nav-link" href="{{ route('admin.orders') }}">Orders</a>
            <a class="nav-link" href="{{ route('admin.reviews') }}">Reviews</a>
        </nav>
    </div>
    <!-- Main Content -->
    <div class="content">
        <div class="container card-container flex justify-center items-center">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded border">
                <div class="card-body">
                    <h1 class="card-title">Create Product</h1>
                    <form action="{{ route('admin.store_product') }}" method="POST" enctype="multipart/form-data" onsubmit="return showAlert()">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('nama_product') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('harga') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required>{{ old('spesifikasi') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function showAlert() {
        const alertCard = document.createElement('div');
        alertCard.className = 'card alert-card';
        alertCard.innerHTML = `
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    Produk berhasil ditambahkan!
                </div>
            </div>
        `;
        document.body.appendChild(alertCard);
        setTimeout(() => {
            alertCard.remove();
        }, 3000);
        return true;
    }
</script>
</body>
</html>

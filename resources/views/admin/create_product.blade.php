<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-create.css') }}">
    <style>
        @font-face {
            font-family: "Josefin Sans";
            src: url("/fonts/josefin-sans/JosefinSans-regular.ttf") format('truetype');
        }

        @font-face {
            font-family: "Verdana";
            src: url("/fonts/verdana/verdana.ttf") format('truerype');
        }

        .sidebar a {
            font-family: "Josefin Sans";
        }

        .content h1 {
            font-family: "Josefin Sans";
        }
        :root {
            --primary: #007bff; /* Primary color */
            --bg-main: #ffffff; /* Sidebar background */
            --text-color: #343a40; /* Text color */
            --hover-color: #e9f5ff; /* Light blue hover */
        }

        body {
            font-family: "Verdana", sans-serif;
            background-color: #f5f5f5; /* Page background */
            margin: 0;
        }

        .sidebar {
            background-color: var(--bg-main);
            color: var(--text-color);
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: var(--text-color);
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
        }

        .sidebar nav {
            flex-grow: 1;
        }

        .sidebar a {
            color: var(--text-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 15px 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
            font-size: 16px;
            margin: 0 10px;
            border-radius: 8px;
        }

        .sidebar a:hover {
            background-color: var(--hover-color);
            color: var(--primary);
        }

        .sidebar a.active {
            background-color: var(--primary);
            color: white;
            font-weight: bold;
            padding: 18px 20px;
        }

        .sidebar a i {
            margin-right: 15px;
            font-size: 20px;
        }

        .logout-btn {
            margin: 10px 10px 20px 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 20px;
            width: calc(100% - 20px);
        }

        .logout-btn:hover {
            background-color: #0056b3;
        }

        .logout-btn i {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div>
        <!-- Sidebar -->
        <div class="sidebar">
        <h2>Admin</h2>
        <nav>
            <a class="" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i> Home
            </a>
            <a class= 'active' href="{{ route('admin.create_product') }}">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <a href="{{ route('admin.orders') }}">
                <i class="bi bi-box"></i> Pesanan
            </a>
            <a href="{{ route('admin.reviews') }}">
                <i class="bi bi-chat-dots"></i> Ulasan
            </a>
            <a href="{{ route('admin.manage_products') }}">
                <i class="bi bi-gear"></i> Kelola Produk
            </a>
        </nav>
        <a href="{{ route('logout') }}" class="logout-btn">
            <i class="bi bi-arrow-left-circle"></i> Logout
        </a>
    </div>
        <!-- Main Content -->
        <div class="content">

            <div class="container card-container d-flex justify-content-center align-items-center">
                <div class="pt-4"></div>
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h1 class="card-title text-center">Create Product</h1>
                        <form action="{{ route('admin.store_product') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="return showAlert()">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category:</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="" selected disabled>Pilih kategori</option>
                                    <option value="headphone" @if (old('category') == 'headphone') selected @endif>
                                        Headphone</option>
                                    <option value="earphone" @if (old('category') == 'earphone') selected @endif>Earphone
                                    </option>
                                    <option value="speaker" @if (old('category') == 'speaker') selected @endif>Speaker
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('harga') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" required>{{ old('spesifikasi') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Create</button>
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

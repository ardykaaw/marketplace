<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sidebar menu</title>
    <style>
        :root {
            --primary: #232946;
            --secondary: #EEBBC3;
            --thirty: #B8C1EC;
            --bg-main: #121629;
            --card: #FFFFFE;
        }

        @font-face {
            font-family: "Josefin Sans";
            src: url("/fonts/josefin-sans/JosefinSans-regular.ttf") format('truetype');
        }

        @font-face {
            font-family: "Verdana";
            src: url("/fonts/verdana/verdana.ttf") format('truerype');
        }

        .sidebar {
            background-color: var(--primary);
            height: 100vh;
            padding: 20px 0;
            width: 350px;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .sidebar a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
            font-size: 22px;
            font-family: "Josefin Sans";
        }

        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>

<body>
  <div class="sidebar">
    <h2 class="text-center">ADMIN</h2>
    <nav class="nav flex-column">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="nav-link" href="{{ route('admin.create_product') }}">Add Product</a>
        <a class="nav-link" href="{{ route('admin.orders') }}">Pesanan</a>
        <a class="nav-link" href="{{ route('admin.reviews') }}">Ulasan</a>
        <a class="nav-link" href="{{ route('admin.manage_products') }}">Kelola Produk</a>
    </nav>
</div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin-reviews.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
<div class="d-flex">
<div class="sidebar">
        <h2>Admin</h2>
        <nav>
            <a class="" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-house"></i> Home
            </a>
            <a  href="{{ route('admin.create_product') }}">
                <i class="bi bi-plus-circle"></i> Add Product
            </a>
            <a href="{{ route('admin.orders') }}">
                <i class="bi bi-box"></i> Pesanan
            </a>
            <a class= 'active'href="{{ route('admin.reviews') }}">
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
    <div class="content container mt-5">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <h1 class="card-title">Reviews</h1>
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Product Name</th>
                            <th>Subject</th>
                            <th>Rating</th>
                            <th>Review</th>
                        </tr>
                    </thead>
                    <tbody id="reviewTableBody">
                        @foreach($reviews as $review)
                        <tr class="review-row">
                            <td>{{ $review->user ? $review->user->name : 'User tidak ditemukan' }}</td>
                            <td>{{ $review->user ? $review->user->email : 'Email tidak tersedia' }}</td>
                            <td>{{ $review->product ? $review->product->nama_product : 'Produk tidak ditemukan' }}</td>
                            <td>{{ $review->subject }}</td>
                            <td>{{ $review->rating }}</td>
                            <td>{{ $review->comment }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    <button id="showMoreBtn" class="btn btn-primary">Show More</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll('.review-row');
        const showMoreBtn = document.getElementById('showMoreBtn');
        let visibleRows = 5;

        function updateVisibility() {
            rows.forEach((row, index) => {
                row.style.display = index < visibleRows ? '' : 'none';
            });
            showMoreBtn.style.display = visibleRows >= rows.length ? 'none' : 'inline-block';
        }

        showMoreBtn.addEventListener('click', function() {
            visibleRows += 5;
            updateVisibility();
        });

        updateVisibility();
    });
</script>
</body>
</html>

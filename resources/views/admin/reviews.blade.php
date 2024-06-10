<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/admin-reviews.css')}}">
</head>
<body>
<div class="d-flex">
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

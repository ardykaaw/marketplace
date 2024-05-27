<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Review</title>
</head>
<body>
    <h1>Buat Review Baru</h1>
    <!-- Form untuk membuat review -->
    <form method="POST" action="{{ route('review.store') }}">
        @csrf
        <!-- Form fields -->
        <button type="submit">Submit Review</button>
    </form>
</body>
</html>

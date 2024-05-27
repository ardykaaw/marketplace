<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }
        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            margin-bottom: 20px;
            padding: 20px; /* Padding diperbesar */
            border-radius: 10px;
            opacity: 0;
            transform: translateY(50px);
            animation: fadeInUp 0.8s forwards;
        }
        .card-custom:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card-image {
            width: 100%; /* Ukuran gambar disesuaikan */
            height: auto; /* Tinggi gambar disesuaikan */
            object-fit: contain; /* Mengubah fit agar gambar tidak terpotong */
            border-radius: 8px;
        }
        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-left: 20px;
        }
        .card-title {
            font-size: 20px; /* Ukuran font diperbesar */
            font-weight: bold;
            margin-bottom: 10px; /* Margin diperbesar */
        }
        .card-text {
            font-size: 16px; /* Ukuran font diperbesar */
            color: #666;
        }
        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px; /* Margin diperbesar */
        }
        .btn {
            border: none;
            padding: 10px 20px; /* Padding diperbesar */
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kelola Produk</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
        <a href="{{ route('admin.create_product') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>
        <div class="row">
            @forelse ($products ?? [] as $product)
            <div class="col-md-4">
                <div class="card card-custom" style="display: flex; flex-direction: row;">
                    <div class="col-md-6">
                        <img src="{{ asset($product->image_path) }}" alt="Gambar Produk" class="card-image">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_product }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($product->harga, 2, ',', '.') }}</p>
                            <p class="card-text">{{ $product->spesifikasi }}</p>
                            <div class="card-actions">
                                <a href="{{ route('admin.edit_product', $product->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('admin.delete_product', $product->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-md-12">
                <p class="text-center">Tidak ada produk yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menambahkan event listener untuk scroll
        window.addEventListener('scroll', () => {
            const cards = document.querySelectorAll('.card-custom');
            const triggerBottom = window.innerHeight / 5 * 4;

            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if(cardTop < triggerBottom) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(50px)';
                }
            });
        });
    </script>
</body>
</html>

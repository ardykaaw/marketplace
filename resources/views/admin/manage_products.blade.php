<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-manageProduct.css') }}">

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kelola Produk</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
        <a href="{{ route('admin.create_product') }}" class="btn btn-primary mb-3">Tambah Produk Baru</a>
        <div class="row">
            @forelse ($products ?? [] as $product)
            <div class="col-md-6">
                <div class="card card-custom" style="display: flex; flex-direction: row;">
                    <div class="col-md-6">
                        <img src="{{ asset($product->image_path) }}" alt="Gambar Produk" class="card-image">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->nama_product }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($product->harga, 2, ',', '.') }}</p>
                            <p class="card-text">
                            @php
                                    $specification = explode("\n", $product->spesifikasi);
                                @endphp

                                @foreach ($specification as $spec)
                                    {{ $spec }}<br>
                                @endforeach
                                </p>
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

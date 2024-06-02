<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Menambahkan shadow awal */
        }
        .card:hover {
            transform: translateY(-10px) scale(1.05); /* Menambahkan efek timbul dan sedikit membesar */
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); /* Menambahkan shadow yang lebih tinggi saat hover */
        }
        .scrollable-table {
            max-height: 300px;
            overflow-y: auto;
        }
        .loader {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 80px;
            height: 80px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <!-- Di dalam <head> -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #1a1a2e;">
<div class="loader" id="loader"></div> <!-- Loader animasi -->
<div> 
    @include('navbar')
</div>
<div class="container mt-5 pt-5">
    <h2 class="mb-4" style="color: white">Profil Pengguna</h2>
    <div class="row">
        <div class="col-md-8">
            @if(Auth::user())
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Profil</h5>
                        <p class="card-text"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                        <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p class="card-text"><strong>Alamat:</strong> {{ Auth::user()->address }}</p> <!-- Menambahkan informasi alamat -->
                        <p class="card-text"><strong>Tanggal Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                </div>
                @if(Auth::user()->orders)
                    <div class="card mt-4">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat Pesanan</h5>
                            <div class="scrollable-table">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <th>Gambar</th> <!-- Kolom baru untuk gambar -->
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th> <!-- Kolom baru untuk aksi -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (Auth::user()->orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td><img src="{{ asset($order->product->image_path)}}" alt="Gambar Produk" style="width: 50px; height: auto;"></td> <!-- Menampilkan gambar produk -->
                                                <td>{{ $order->product->nama_product }}</td>
                                                <td>{{ $order->product->harga }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#reviewModal" onclick="setOrderId({{ $order->id }})">Beri Ulasan</button>
                                                    <button class="btn btn-danger" onclick="deleteOrder({{ $order->id }})">Hapus</button>
                                                </td> <!-- Tautan untuk memberikan ulasan dan tombol hapus -->
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">Tidak ada riwayat pesanan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <p class="card-text">Pengguna tidak ditemukan.</p>
            @endif
        </div>
        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Aksi</h5>
                    <div class="d-grid gap-2">
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary w-100">Edit Profil</a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">Keluar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ulasan -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div the="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Beri Ulasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('review.store') }}">
                    @csrf
                    <input type="hidden" name="order_id" id="order_id">
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <input type="number" class="form-control" id="rating" name="rating" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Komentar</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var loader = document.getElementById("loader");
    loader.style.display = "none";
});

function setOrderId(orderId) {
    document.getElementById('order_id').value = orderId;
}

function deleteOrder(orderId) {
    if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
        var loader = document.getElementById("loader");
        loader.style.display = "block";
        $.ajax({
            url: '{{ url("order/delete") }}/' + orderId,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function(result) {
                alert('Pesanan berhasil dihapus');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Gagal menghapus pesanan: ' + error);
                loader.style.display = "none";
            }
        });
    }
}
</script>

<!-- Sebelum penutup </body> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


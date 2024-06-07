<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/viewProfile.css') }}">
</head>

<body style="background-color: #1a1a2e;">
    <div class="loader" id="loader"></div> <!-- Loader animasi -->
    <div>
        @include('navbar')
    </div>
    <div class="container mt-5 pt-5">
        <div class="row section">
            <div class="col-md-4 sidebarLeft">
                @if (Auth::user())
                    <p>{{ Auth::user()->name }}<br>
                        <span class="emailSidebarleft">{{ Auth::user()->email }}</span>
                    </p>
                    <p>Akun saya</p>
                    <p><a class="text-white text-decoration-none" href="{{ route('profile.riwayatPesanan') }}">Riwayat pesanan</a></p>
                    <p><a class="text-white text-decoration-none" href="{{ route('profile.edit') }}">Edit profile</a></p>
                    <p><a class="text-white text-decoration-none" href="{{ route('logout') }}">LogOut</a></p>
                @endif
            </div>
            <div class="col-md-8">
                @if (Auth::user())
                    <div class="card sidebarRight">
                        <div class="circleProfilBlue"></div>
                        <div class="circleProfilPink"></div>
                        <div class="card-body">
                            <h5 class="card-title">Detail Profil</h5>
                            <p class="card-text"><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                            <p class="card-text"><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p class="card-text"><strong>Alamat:</strong> {{ Auth::user()->address }}</p>
                            <p class="card-text"><strong>Tanggal Bergabung:</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @else
                    <p class="card-text">Pengguna tidak ditemukan.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
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
            document.getElementById("loader").style.display = "none";
        });

        function setOrderId(orderId) {
            document.getElementById('order_id').value = orderId;
        }

        function deleteOrder(orderId) {
            if (confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
                document.getElementById("loader").style.display = "block";
                $.ajax({
                    url: '{{ url('order/delete') }}/' + orderId,
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
                        document.getElementById("loader").style.display = "none";
                    }
                });
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

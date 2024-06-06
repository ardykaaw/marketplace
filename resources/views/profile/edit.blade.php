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
                    <p>{{ Auth::user()->name }}
                        <br>
                        <span class="emailSidebarleft">
                            {{ Auth::user()->email }}
                        </span>
                    </p>
                    <p> <a href="{{ route('profile.view') }}">Akun saya</a> </p>
                    <p> <a class="text-white text-decoration-none" href="{{ route('profile.riwayatPesanan') }}">Riwayat pesanan</a> </p>
                    <p> <a class="text-white text-decoration-none" href="{{ route('profile.edit') }}">Edit profil</a> </p>
                    <p> <a class="text-white text-decoration-none" href="{{ route('logout') }}">LogOut</a> </p>
                @endif
            </div>
            <div class="col-md-8">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ optional(Auth::user())->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ optional(Auth::user())->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ optional(Auth::user())->address }}" placeholder="Tambahkan alamat" required>
                    </div>
                    <div class="buttonContactUs">
                        <button type="submit" class="btn btn-primary">Perbarui Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Ulasan -->
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
                        loader.style.display = "none";
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

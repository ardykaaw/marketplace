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
                @auth
                    <p>{{ Auth::user()->name }}
                        <br>
                        <span class="emailSidebarleft">
                            {{ Auth::user()->email }}
                        </span>
                    </p>
                    <p> <a href="{{ route('profile.view') }}">Akun saya</a> </p>
                    <p> <a style="text-decoration: none; color: white" href="{{ route('profile.riwayatPesanan') }}">Riwayat
                            pesanan</a> </p>
                    <p> <a style="text-decoration: none; color: white" href="{{ route('profile.edit') }}">Edit profile</a>
                    </p>
                    <p> <a style="text-decoration: none; color: white" href="{{ route('logout') }}">LogOut</a> </p>
                @endauth
            </div>
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Pesanan</h5>
                        <div class="scrollable-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="orderTableBody">
                                    @auth
                                        @if (Auth::user()->orders()->exists())
                                            @forelse (Auth::user()->orders as $order)
                                                <tr id="order-row-{{ $order->id }}">
                                                    <td>{{ $order->id }}</td>
                                                    <td>
                                                        <img src="{{ asset($order->product->image_path) }}"
                                                            alt="Gambar Produk" style="width: 50px; height: auto;">
                                                    </td>
                                                    <td>{{ $order->product->nama_product }}</td>
                                                    <td>{{ $order->cart_product ? $order->cart_product->quantity : 'No data' }}
                                                    </td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <button class="btn btn-primary" data-toggle="modal"
                                                            data-target="#reviewModal"
                                                            onclick="setOrderId({{ $order->id }})">Beri Ulasan</button>
                                                        <button class="btn btn-danger"
                                                            onclick="deleteOrder({{ $order->id }})">Hapus</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Tidak ada riwayat pesanan.</td>
                                                </tr>
                                            @endforelse
                                        @else
                                            <tr>
                                                <td colspan="7">Tidak ada riwayat pesanan.</td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td colspan="7">Pengguna tidak ditemukan.</td>
                                        </tr>
                                    @endauth
                                </tbody>
                            </table>
                            @auth
                                @if (Auth::user()->orders->count() > 10)
                                    <button id="showMoreBtn" class="btn btn-secondary" onclick="showMoreOrders()">Tampilkan
                                        Lebih Banyak</button>
                                    <button id="showLessBtn" class="btn btn-secondary" onclick="showLessOrders()"
                                        style="display: none;">Tampilkan Lebih Sedikit</button>
                                @endif
                            @endauth
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
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        alert('Pesanan berhasil dihapus');
                        document.getElementById('order-row-' + orderId).remove();
                        document.getElementById("loader").style.display = "none";
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal menghapus pesanan: ' + error);
                        document.getElementById("loader").style.display = "none";
                    }
                });
            }
        }

        function showMoreOrders() {
            var rows = document.querySelectorAll('#orderTableBody tr');
            for (var i = 10; i < rows.length; i++) {
                rows[i].style.display = 'table-row';
            }
            document.getElementById('showMoreBtn').style.display = 'none';
            document.getElementById('showLessBtn').style.display = 'inline-block';
        }

        function showLessOrders() {
            var rows = document.querySelectorAll('#orderTableBody tr');
            for (var i = 10; i < rows.length; i++) {
                rows[i].style.display = 'none';
            }
            document.getElementById('showMoreBtn').style.display = 'inline-block';
            document.getElementById('showLessBtn').style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function() {
            var rows = document.querySelectorAll('#orderTableBody tr');
            if (rows.length > 10) {
                for (var i = 10; i < rows.length; i++) {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

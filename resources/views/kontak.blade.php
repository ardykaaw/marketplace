<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

</head>

<body>
    {{-- <div class="loader" id="loader"></div> --}}
    <div class="contentContact pt-5" id="content">
        {{-- @include('navbar') --}}

        <div class="container pt-5">
            <h2 class="contact-title">CONTACT US</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        {{-- <div class="card-body"> --}}
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d254731.00089136284!2d122.37223180197881!3d-3.98503326612932!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d98ecde0b6b7183%3A0x1397347f9e562fc7!2sKendari%2C%20Kota%20Kendari%2C%20Sulawesi%20Tenggara!5e0!3m2!1sid!2sid!4v1717952026473!5m2!1sid!2sid"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-md-6 flex items-center ">
                    <form action="{{ url('/submit-kontak') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="user_id_value">
                        <!-- Sesuaikan cara mendapatkan user_id -->
                        <input type="hidden" name="product_id" value="product_id_value">
                        <!-- Sesuaikan cara mendapatkan product_id -->
                        <input type="hidden" name="rating" value="5">
                        <!-- Contoh static rating, sesuaikan sesuai kebutuhan -->
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Subjek">
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="pesan" name="pesan" rows="3" placeholder="Pesan"></textarea>
                        </div>
                        <div class="buttonContactUs">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- @include('footer') --}}
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loader = document.getElementById('loader');
            const content = document.getElementById('content');

            // Menampilkan loader
            loader.style.display = 'block';
            content.style.display = 'none';

            window.onload = function() {
                // Menyembunyikan loader dan menampilkan konten setelah halaman dimuat
                loader.style.display = 'none';
                content.style.display = 'block';
            };
        });
    </script>
</body>

</html>

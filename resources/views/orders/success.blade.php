<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
</head>
<body>    
    <style>
        :root {
                --primary: #232946;
                --secondary: #EEBBC3;
                --thirty: #B8C1EC;
                --bg-main: #121629;
                --card: #FFFFFE;
            }
             html body {
                background-color: var(--bg-main);
            }
            .container {
                color: white;
            }
    </style>
    <div class="container mt-5 pt-3">
        @include('navbar')
        <h1 class="display-4">Pesanan Berhasil</h1>
        <p class="lead">Terima kasih telah memesan produk kami. Pesanan Anda sedang diproses.</p>
        <a href="{{ route('produk') }}" class="btn btn-primary mt-3">Kembali Belanja</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <style>
        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            width: 50%; /* Mengatur lebar card */
            margin: auto; /* Menempatkan card di tengah */
        }
        .card-custom:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Produk</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!-- Alert for success start -->
                        @if(session('success'))
                        <div class="card card-custom">
                            <div class="card-body">
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- Alert for success end -->
                        <!-- Card start -->
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Formulir Edit Produk</h3>
                            </div>
                            <div class="card-body">
                                <!-- Form start -->
                                <form action="{{ route('admin.update_product', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nama Produk:</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->nama_product }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Harga:</label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{ $product->harga }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Spesifikasi:</label>
                                        <textarea class="form-control" id="description" name="description" required>{{ $product->spesifikasi }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Gambar Produk:</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="Current Image" class="img-thumbnail mt-2" style="width: 150px;">
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Update Produk</button>
                                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
                                    </div>
                                </form>
                                <!-- Form end -->
                            </div>
                        </div>
                        <!-- Card end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
</body>
</html>

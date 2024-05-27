@extends('app')

@section('title', 'Detail Order')

@section('content_header')
    <h1>Detail Order</h1>
@stop

@section('content')
<div class="container mt-3 pt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    <h3 class="card-title">Informasi Order</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nama Pelanggan:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Alamat:</strong> {{ $order->user->address }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Tanggal Order:</strong> {{ $order->order_date }}</p>
                            <p><strong>Status:</strong> {{ $order->status }}</p>
                            <p><strong>Total Harga:</strong> Rp{{ number_format($order->product->harga, 2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.orders_edit', $order->id) }}" class="btn btn-primary">Edit Order</a>
                    <form action="{{ route('admin.orders_confirm', $order->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success">Konfirmasi Pengiriman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Halaman detail order di-load'); </script>
@stop

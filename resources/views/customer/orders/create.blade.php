@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Pesanan Baru</h1>

    <div class="card mb-4">
        <div class="card-header">
            {{ $food->food_name }}
        </div>
        <div class="card-body">
            <p><strong>Harga:</strong> Rp. {{ number_format($food->price, 0, ',', '.') }}</p>
            <p><strong>Jenis:</strong> {{ $food->type_of_food }}</p>
            <p><strong>Deskripsi:</strong> {{ $food->description }}</p>
        </div>
    </div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <input type="hidden" name="food_id" value="{{ $food->id }}">

        <div class="form-group">
            <label for="qty">Jumlah Pesanan</label>
            <input type="number" name="qty" id="qty" class="form-control" value="1" min="1" required>
        </div>

        <div class="form-group">
            <label for="delivery_date">Tanggal Pengiriman</label>
            <input type="date" name="delivery_date" id="delivery_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="notes">Catatan</label>
            <textarea name="notes" id="notes" class="form-control" rows="3" placeholder="Tambahkan catatan (opsional)"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Pesan Sekarang</button>
    </form>
</div>
@endsection

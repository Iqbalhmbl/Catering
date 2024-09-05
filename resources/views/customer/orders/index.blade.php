@extends('layouts.app')

@section('title', 'Buat Pesanan Baru')

@section('content')
<div class="container">
    <h1 class="mb-4">Buat Pesanan Baru</h1>

    <div class="card mb-4">
        <div class="card-header">
            List Order
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped text-light">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nomor Pesanan</th>
                            <th>Kuantitas</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Pesanan</th>
                            <th>Tanggal Pengiriman</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->order_number }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->total_price }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->delivery_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

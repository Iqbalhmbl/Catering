@extends('layouts.app')

@section('title', 'Food Items')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="list-group">
                <a href="{{ route('merchant.profile.edit') }}" class="list-group-item list-group-item-action @if(request()->routeIs('merchants.profile.edit')) active @endif">Profil</a>
                <a href="{{ route('foods.index') }}" class="list-group-item list-group-item-action @if(request()->routeIs('foods.create') || request()->routeIs('foods.index')) active @endif">Kelola Menu Makanan</a>
                <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action @if(request()->routeIs('orders.index')) active @endif">Order</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 mb-4">
            <h1 class="mb-4">Menu Makanan</h1>

            @if ($order->isEmpty())
                <p>Menu Makanan Kosong</p>
            @else
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
            @endif
        </div>
    </div>

</div>
@endsection

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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <a href="{{ route('foods.create') }}" class="btn btn-primary mb-4">Tambah Menu Makanan</a>
        
            @if ($foods->isEmpty())
                <p>Menu Makanan Kosong</p>
            @else
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Makanan</th>
                            <th>Harga</th>
                            <th>Jenis Makanan</th>
                            <th>Stok</th>
                            <th>Portion</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                            <tr>
                                <td>
                                    @if ($food->photo)
                                        <img src="{{ asset('food/thumbnail/' . $food->photo) }}" alt="{{ $food->food_name }}" class="img-thumbnail" style="width: 100px;">
                                    @else
                                        No Photo
                                    @endif
                                </td>
                                <td>{{ $food->food_name }}</td>
                                <td>Rp. {{ number_format($food->price) }}</td>
                                <td>{{ $food->type_of_food }}</td>
                                <td>{{ $food->stock }}</td>
                                <td>{{ $food->portions }}</td>
                                <td>{{ $food->description }}</td>
                                <td>
                                    <a href="{{ route('foods.edit', $food->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('foods.destroy', $food->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection

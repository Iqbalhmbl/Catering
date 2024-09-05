@extends('layouts.app')

@section('title', 'Daftar Menu Makanan')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Daftar Menu Makanan</h1>

            <form action="{{ route('customers.index') }}" method="GET" class="mb-4">
                <div class="form-row">
                    <div class="col-md-4">
                        <select name="type_of_food" class="form-control">
                            <option value="">-- Pilih Jenis Makanan --</option>
                            <option value="Sayuran" {{ request('type_of_food') == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                            <option value="Buah-buahan" {{ request('type_of_food') == 'Buah-buahan' ? 'selected' : '' }}>Buah-buahan</option>
                            <option value="Makanan Berat" {{ request('type_of_food') == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                            <option value="snack" {{ request('type_of_food') == 'snack' ? 'selected' : '' }}>Snack</option>
                            <option value="minuman" {{ request('type_of_food') == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-12">
                    @foreach($foods as $food)
                        <div class="card mb-4">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    @if ($food->photo)
                                        <img src="{{ asset('food/thumbnail/' . $food->photo) }}" alt="{{ $food->food_name }}" class="card-img" style="height: 100%; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('no-image.png') }}" alt="No Image" class="card-img" style="height: 100%; object-fit: cover;">
                                    @endif
                                </div>
                                
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $food->food_name }}</h5>
                                        <p class="card-text">Harga: <strong>Rp. {{ number_format($food->price, 0, ',', '.') }}</strong></p>
                                        <p class="card-text">Jenis: {{ $food->type_of_food }}</p>
                                        <p class="card-text">Stok: {{ $food->stock }}</p>
                                        <p class="card-text">Porsi: {{ $food->portions }}</p>
                                        <p class="card-text">{{ $food->description }}</p>
                                        <a href="{{ route('customers.orders', ['id' => $food->id]) }}" class="btn btn-sm btn-primary">Order Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

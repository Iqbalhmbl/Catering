@extends('layouts.app')

@section('title', 'Edit Menu Makanan')

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
            <h1 class="mb-4">Edit Menu Makanan</h1>
            <form action="{{ route('foods.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <img src="{{ asset('food/'.$food->photo) }}" alt="{{ $food->food_name }}" width="400">
                    <br>
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="food_name">Nama Makanan</label>
                    <input type="text" class="form-control" id="food_name" name="food_name" value="{{ old('food_name', $food->food_name) }}" required>
                    @error('food_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $food->price) }}" step="0.01" required>
                    @error('price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="type_of_food">Jenis Makanan</label>
                    <select class="form-control" id="type_of_food" name="type_of_food" required>
                        <option value="" disabled>Pilih Jenis Makanan</option>
                        <option value="Sayuran" {{ old('type_of_food', $food->type_of_food) == 'Sayuran' ? 'selected' : '' }}>Sayuran</option>
                        <option value="Buah-buahan" {{ old('type_of_food', $food->type_of_food) == 'Buah-buahan' ? 'selected' : '' }}>Buah-buahan</option>
                        <option value="Makanan Berat" {{ old('type_of_food', $food->type_of_food) == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                        <option value="snack" {{ old('type_of_food', $food->type_of_food) == 'snack' ? 'selected' : '' }}>Snack</option>
                        <option value="minuman" {{ old('type_of_food', $food->type_of_food) == 'minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                    @error('type_of_food')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $food->stock) }}" required>
                    @error('stock')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="portions">Porsi</label>
                    <input type="text" class="form-control" id="portions" name="portions" value="{{ old('portions', $food->portions) }}" required>
                    @error('portions')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $food->description) }}</textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

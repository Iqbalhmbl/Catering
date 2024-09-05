@extends('layouts.app')

@section('title', 'Dashboard Merchant')

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

        <div class="col-md-9 mb-4">
            <section class="hero">
                <div class="container">
                    <h1>Selamat Datang di Katering Portal</h1>
                </div>
            </section>

            <div>
                <h1 class="mb-4">Welcome to Your Dashboard</h1>
               
            </div>
        </div>
    </div>
</div>
@endsection

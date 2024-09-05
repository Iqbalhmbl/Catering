<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\OrderController;
Route::get('/', function () {
    return view('login');
});
Route::get('/form-register', [AuthController::class, 'formRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
Route::get('/customers/orders/view', [CustomerController::class, 'orderIndex'])->name('customers.orders.index');
Route::get('/customers/orders', [CustomerController::class, 'order'])->name('customers.orders');
Route::post('/customers/order/store', [CustomerController::class, 'storeOder'])->name('orders.store');
Route::get('/customers/profile', [CustomerController::class, 'profile'])->name('customers.profile');



Route::get('/merchants', [MerchantController::class, 'index'])->name('merchants.index');
Route::resource('foods', FoodController::class);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/merchants/profile/edit', [MerchantController::class ,'editProfile'])->name('merchant.profile.edit');
Route::put('/merchants/profile/update', [MerchantController::class, 'updateProfile'])->name('merchants.profile.update');

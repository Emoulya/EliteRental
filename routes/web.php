<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VehicleController;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- Rute Admin ---
// Menggunakan Route::prefix('admin') dan Route::name('admin.')
// untuk mengorganisir semua rute admin di bawah satu grup.
// Middleware 'auth' dan 'role:admin' diterapkan ke seluruh grup ini.
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard'); // Nama rute akan menjadi 'admin.dashboard'

    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles');
    Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('bookings'); // Nama rute akan menjadi 'admin.bookings'

    // Jika ada halaman untuk membuat booking baru
    Route::get('/bookings/create', function () {
        return view('admin.bookings.create'); // Contoh: resources/views/admin/bookings/create.blade.php
    })->name('bookings.create'); // Nama rute akan menjadi 'admin.bookings.create'

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('customers'); // Nama rute akan menjadi 'admin.customers'

    Route::get('/finance', function () {
        return view('admin.finance');
    })->name('finance'); // Nama rute akan menjadi 'admin.finance'

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports'); // Nama rute akan menjadi 'admin.reports'

    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings'); // Nama rute akan menjadi 'admin.settings'

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

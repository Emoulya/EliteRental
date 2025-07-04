<?php
// routes\web.php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\VehicleListController;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/kendaraan', [VehicleListController::class, 'index'])->name('vehicles.index');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- Rute Admin ---
// Menggunakan Route::prefix('admin') dan Route::name('admin.')
// Middleware 'auth' dan 'role:admin' diterapkan ke seluruh grup ini.
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::get('/vehicles/{vehicle}/detail', [VehicleController::class, 'show'])->name('vehicles.show');

    Route::resource('vehicles', VehicleController::class)->names([
        'index' => 'vehicles',
        'store' => 'vehicles.store',
        'update' => 'vehicles.update',
        'destroy' => 'vehicles.destroy',
    ])->except(['create', 'edit']);

    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('bookings');

    // Jika ada halaman untuk membuat booking baru
    Route::get('/bookings/create', function () {
        return view('admin.bookings.create');
    })->name('bookings.create');

    Route::get('/customers', function () {
        return view('admin.customers');
    })->name('customers');

    Route::get('/reports', function () {
        return view('admin.reports');
    })->name('reports');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

<?php
// routes\web.php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleUnitController;
use App\Http\Controllers\VehicleListController;
use App\Http\Controllers\VehicleDetailController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ConfirmationController;
use App\Http\Middleware\RoleMiddleware;
use Carbon\Carbon;

// --- Rute Publik (Bisa diakses siapa saja: Guest, User, Admin) ---
Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/kendaraan', [VehicleListController::class, 'index'])->name('vehicles.index');
Route::get('/kendaraan/{vehicle}', [VehicleDetailController::class, 'show'])->name('vehicles.show_public');

// --- Rute Admin (Hanya bisa diakses oleh user dengan role 'admin') ---
// Middleware 'auth' memastikan user sudah login.
// Middleware 'role:admin' memastikan user memiliki role 'admin'.
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Rute manajemen kendaraan (model)
    Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
    Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');
    Route::get('/vehicles/{vehicle}/detail', [VehicleController::class, 'show'])->name('vehicles.show');

    Route::resource('vehicles', VehicleController::class)->names([
        'index' => 'vehicles',
        'store' => 'vehicles.store',
        'update' => 'vehicles.update',
        'destroy' => 'vehicles.destroy',
    ])->except(['create', 'edit', 'show']);

    // Rute manajemen unit kendaraan
    Route::resource('vehicles.units', VehicleUnitController::class)->only(['store', 'update', 'destroy'])
        ->parameters(['units' => 'unit'])
        ->names([
            'store' => 'vehicles.units.store',
            'update' => 'vehicles.units.update',
            'destroy' => 'vehicles.units.destroy',
        ]);

    // Rute lainnya untuk admin
    Route::get('/bookings', function () {
        return view('admin.bookings');
    })->name('bookings');

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


// --- Rute Pengguna Terautentikasi (Hanya bisa diakses oleh user yang sudah login DAN memiliki role 'user') ---
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute baru untuk menyimpan ringkasan booking awal
    Route::post('/booking/summary', [BookingController::class, 'storeBookingSummary'])->name('booking.store_summary');

    // Mengubah rute untuk halaman detail booking, sekarang menerima ID booking
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    // Rute untuk mengupdate catatan khusus pada booking
    Route::put('/booking/{booking}/update-notes', [App\Http\Controllers\BookingController::class, 'updateNotes'])->name('booking.update_notes');

    // Mengubah rute untuk halaman pembayaran, sekarang menerima ID booking
    Route::get('/payment/{booking}', [PaymentController::class, 'show'])->name('payment.show');

    // Route untuk halaman konfirmasi
    Route::get('/confirmation', [ConfirmationController::class, 'show'])->name('booking.confirmation');
});


// --- Rute Autentikasi (Login, Register, dll.) ---
require __DIR__ . '/auth.php';

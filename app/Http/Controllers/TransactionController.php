<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking; // Import model Booking

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar transaksi (booking) untuk user yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Ambil semua booking yang dimiliki oleh user ini,
        // eager load relasi vehicleUnit dan vehicle untuk detail tampilan.
        $bookings = Booking::where('user_id', $userId)
            ->with(['vehicleUnit.vehicle'])
            ->latest() // Urutkan dari yang terbaru
            ->paginate(10); // Tambahkan paginasi

        return view('pages.transactions.index', compact('bookings'));
    }
}

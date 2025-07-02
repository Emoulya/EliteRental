<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleListController extends Controller
{
    /**
     * Menampilkan daftar semua kendaraan yang tersedia untuk pelanggan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua data kendaraan dari database.
        // Anda bisa menambahkan filter atau paginasi di sini sesuai kebutuhan.
        // Contoh: $vehicles = Vehicle::where('status', 'available')->paginate(12);
        $vehicles = Vehicle::all(); // Mengambil semua kendaraan tanpa filter status untuk demo filter JS

        // Meneruskan data kendaraan ke view
        return view('pages.vehicles', compact('vehicles'));
    }
}

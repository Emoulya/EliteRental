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
        $vehicles = Vehicle::paginate(12);

        // Meneruskan data kendaraan ke view
        return view('pages.vehicles', compact('vehicles'));
    }
}

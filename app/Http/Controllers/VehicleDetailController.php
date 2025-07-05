<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleDetailController extends Controller
{
    /**
     * Menampilkan halaman detail untuk kendaraan tertentu.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\View\View
     */
    public function show(Vehicle $vehicle)
    {
        $vehicle->loadCount(['units as total_units_count'])
            ->loadCount(['units as available_units_count' => function ($q) {
                $q->where('status', 'tersedia');
            }]);

        $vehicle->load('units');

        // Untuk kendaraan serupa, kita bisa mengambil beberapa kendaraan dari kategori yang sama
        $similarVehicles = Vehicle::where('category', $vehicle->category)
            ->where('id', '!=', $vehicle->id)
            ->withCount(['units as available_units_count' => function ($q) {
                $q->where('status', 'tersedia');
            }])
            ->limit(3)
            ->get();

        return view('pages.vehicle-detail', compact('vehicle', 'similarVehicles'));
    }
}

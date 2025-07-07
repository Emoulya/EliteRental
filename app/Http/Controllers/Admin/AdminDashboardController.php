<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleUnit;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk statistik
        $totalVehicles = Vehicle::count();
        $totalUnits = VehicleUnit::count();
        $availableUnits = VehicleUnit::where('status', 'tersedia')->count();
        $rentedUnits = VehicleUnit::where('status', 'disewa')->count();
        $maintenanceUnits = VehicleUnit::where('status', 'maintenance')->count();
        $unavailableUnits = VehicleUnit::where('status', 'unavailable')->count();
        $totalCustomers = User::where('role', 'user')->count();

        // Dummy data untuk pendapatan dan booking karena belum ada modelnya
        $revenueThisMonth = 'Rp 45.2M'; // Contoh: total pendapatan dari transaksi bulan ini
        $totalBookings = 156; // Contoh: jumlah total booking

        // Persentase untuk chart status kendaraan
        $availablePercentage = $totalUnits > 0 ? round(($availableUnits / $totalUnits) * 100) : 0;
        $rentedPercentage = $totalUnits > 0 ? round(($rentedUnits / $totalUnits) * 100) : 0;
        $maintenancePercentage = $totalUnits > 0 ? round(($maintenanceUnits / $totalUnits) * 100) : 0;


        return view('admin.dashboard', compact(
            'totalVehicles',
            'totalUnits',
            'availableUnits',
            'rentedUnits',
            'maintenanceUnits',
            'unavailableUnits',
            'totalCustomers',
            'revenueThisMonth',
            'totalBookings',
            'availablePercentage',
            'rentedPercentage',
            'maintenancePercentage'
        ));
    }
}

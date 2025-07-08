<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleUnit;
use App\Models\User;
use App\Models\Booking;
use App\Models\Payment;
use Carbon\Carbon;

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

        // Ambil data riil untuk pendapatan dan total booking
        // Pendapatan Bulan Ini: Jumlah pembayaran yang statusnya 'paid' untuk bulan dan tahun saat ini
        $revenueThisMonth = Payment::where('status', 'paid')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year)
            ->sum('amount');

        // Total Booking: Jumlah semua booking
        $totalBookings = Booking::count();

        // Format pendapatan agar lebih mudah dibaca di tampilan
        $revenueThisMonthFormatted = 'Rp ' . number_format($revenueThisMonth, 0, ',', '.');


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
            'revenueThisMonthFormatted',
            'totalBookings',
            'availablePercentage',
            'rentedPercentage',
            'maintenancePercentage'
        ));
    }
}

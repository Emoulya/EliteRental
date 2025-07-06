<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Menampilkan halaman detail booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // Mendapatkan data dari query parameter atau input POST
        $vehicleId = $request->input('vehicle_id');
        $plateNumber = $request->input('plate_number');
        $durationType = $request->input('duration_type');
        $quantity = $request->input('quantity');
        $totalPrice = $request->input('total_price');

        // Ambil data kendaraan dari database
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Contoh perhitungan sederhana untuk pajak/biaya admin (5%)
        $taxAdminFee = $totalPrice * 0.05;
        $finalTotalPrice = $totalPrice + $taxAdminFee;


        return view('pages.booking-detail', compact(
            'vehicle',
            'plateNumber',
            'durationType',
            'quantity',
            'totalPrice',
            'taxAdminFee',
            'finalTotalPrice'
        ));
    }
}

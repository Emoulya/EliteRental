<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // Mendapatkan data booking dari query parameter
        $vehicleId = $request->input('vehicle_id');
        $plateNumber = $request->input('plate_number');
        $durationType = $request->input('duration_type');
        $quantity = $request->input('quantity');
        $subTotalPrice = $request->input('total_price'); // Ini total harga sebelum pajak

        // Validasi dasar
        if (!$vehicleId || !$plateNumber || !$durationType || !$quantity || !$subTotalPrice) {
            return redirect()->route('vehicles.index')->with('error', 'Data booking tidak lengkap. Silakan coba lagi.');
        }

        $vehicle = Vehicle::findOrFail($vehicleId);

        // Perhitungan biaya tambahan (misal: 5% dari sub total)
        $taxAdminFee = $subTotalPrice * 0.05;
        $finalTotalPrice = $subTotalPrice + $taxAdminFee;

        // Waktu kadaluarsa pembayaran (misal: 24 jam dari sekarang)
        $paymentExpiry = Carbon::now()->addHours(24);

        $orderId = '#ER' . Carbon::now()->format('ymd') . sprintf('%03d', rand(1, 999));

        return view('pages.payment', compact(
            'vehicle',
            'plateNumber',
            'durationType',
            'quantity',
            'subTotalPrice',
            'taxAdminFee',
            'finalTotalPrice',
            'paymentExpiry',
            'orderId',
        ));
    }
}

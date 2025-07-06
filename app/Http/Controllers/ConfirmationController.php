<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ConfirmationController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi pesanan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // Mendapatkan data dari query parameter (contoh, dalam nyata bisa dari DB berdasarkan order_id)
        $vehicleId = $request->input('vehicle_id');
        $plateNumber = $request->input('plate_number');
        $durationType = $request->input('duration_type');
        $quantity = $request->input('quantity');
        $subTotalPrice = $request->input('sub_total_price');
        $taxAdminFee = $request->input('tax_admin_fee');
        $finalTotalPrice = $request->input('final_total_price');
        $orderId = $request->input('order_id');
        $paymentMethod = $request->input('payment_method');
        // Asumsi data user dari Auth
        $userName = Auth::user()->name ?? 'Pengguna';
        $userEmail = Auth::user()->email ?? 'email@example.com';
        // Asumsi data lain seperti phone, ktp, sim tidak di pass, tapi bisa ditambahkan ke model User jika diperlukan
        $userPhone = 'N/A'; // Placeholder
        $userKtp = 'N/A'; // Placeholder

        // Ambil data kendaraan dari database
        $vehicle = Vehicle::findOrFail($vehicleId);

        // Contoh periode sewa (tanggal mulai dan selesai)
        // Dalam aplikasi nyata, ini akan dari data booking yang sebenarnya
        $rentalStartDate = Carbon::now()->addDay(); // Mulai besok
        $rentalEndDate = $rentalStartDate->copy()->addDays($quantity - 1);

        // Data lokasi (contoh hardcoded)
        $pickupLocationName = 'Elite Rental - Bandung';
        $pickupLocationAddress = 'Jl. Asia Afrika No. 123, Bandung';
        $pickupLocationHours = '08:00 - 17:00 WIB';
        $returnLocationName = 'Elite Rental - Bandung';
        $returnLocationAddress = 'Jl. Asia Afrika No. 123, Bandung';
        $returnLocationHours = '08:00 - 17:00 WIB';


        return view('pages.confirmation', compact(
            'vehicle',
            'plateNumber',
            'durationType',
            'quantity',
            'subTotalPrice',
            'taxAdminFee',
            'finalTotalPrice',
            'orderId',
            'paymentMethod',
            'userName',
            'userEmail',
            'userPhone',
            'userKtp',
            'rentalStartDate',
            'rentalEndDate',
            'pickupLocationName',
            'pickupLocationAddress',
            'pickupLocationHours',
            'returnLocationName',
            'returnLocationAddress',
            'returnLocationHours'
        ));
    }
}

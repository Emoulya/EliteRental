<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ConfirmationController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi pesanan.
     * Sekarang menerima objek Booking melalui Route Model Binding.
     *
     * @param  \App\Models\Booking  $booking
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Booking $booking, Request $request)
    {
        if ($booking->user_id !== Auth::id()) {
            // Jika booking bukan milik user yang login, arahkan kembali ke halaman transaksi mereka
            // atau Anda bisa menggunakan abort(403, 'Unauthorized access.'); untuk menampilkan error 403.
            return redirect()->route('transactions.index')->with('error_message', 'Anda tidak diizinkan melihat detail pesanan ini.');
        }
        // Muat relasi yang diperlukan untuk objek booking
        $booking->load('user.customerProfile', 'vehicleUnit.vehicle');

        // Ambil data yang dibutuhkan langsung dari objek $booking dan relasinya
        $vehicle = $booking->vehicleUnit->vehicle;
        $plateNumber = $booking->vehicleUnit->license_plate;
        $durationType = $booking->duration_type;
        $quantity = $booking->quantity;

        // Ambil detail harga yang sudah disimpan di database
        $subTotalPrice = $booking->sub_total_price;
        $taxAdminFee = $booking->tax_admin_fee;
        $finalTotalPrice = $booking->total_price;

        // Ambil payment_method dari query parameter yang dikirim dari PaymentController
        $paymentMethod = $request->input('payment_method');

        // Informasi user dari relasi booking
        $userName = $booking->user->name ?? 'Pengguna';
        $userEmail = $booking->user->email ?? 'email@example.com';
        $userPhone = $booking->user->customerProfile->phone_number ?? 'N/A';
        $userKtp = $booking->user->customerProfile->ktp_number ?? 'N/A';
        $userSim = $booking->user->customerProfile->sim_number ?? 'N/A';

        // Order ID bisa diambil dari ID Booking atau format yang lebih kompleks
        $orderId = '#ER' . $booking->id . $booking->created_at->format('His');

        // Tanggal sewa dan pengembalian dari objek booking
        $rentalStartDate = $booking->start_date;
        $rentalEndDate = $booking->end_date;

        // Data lokasi (contoh hardcoded)
        $pickupLocationName = 'Elite Rental - Bandung';
        $pickupLocationAddress = 'Jl. Asia Afrika No. 123, Bandung';
        $pickupLocationHours = '08:00 - 17:00 WIB';
        $returnLocationName = 'Elite Rental - Bandung';
        $returnLocationAddress = 'Jl. Asia Afrika No. 123, Bandung';
        $returnLocationHours = '08:00 - 17:00 WIB';

        return view('pages.confirmation', compact(
            'booking',
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
            'userSim',
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

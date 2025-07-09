<?php
// app\Http\Controllers\PaymentController.php
namespace App\Http\Controllers;

use App\Models\Vehicle; // Mungkin tidak lagi diperlukan secara langsung jika semua melalui Booking
use App\Models\Booking; // Import model Booking
use App\Models\Payment; // Import model Payment
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran untuk booking tertentu.
     * Sekarang menerima objek Booking melalui Route Model Binding.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\View\View
     */
    public function show(Booking $booking)
    {
        // Pastikan relasi yang dibutuhkan sudah dimuat
        $booking->load('user.customerProfile', 'vehicleUnit.vehicle');

        // Data booking sudah ada di objek $booking
        $finalTotalPrice = $booking->total_price;

        // Perhitungan biaya tambahan (misal: 5% dari sub total)
        // Kita perlu menghitung ulang sub total jika kita hanya menyimpan final total di booking
        $taxRate = 0.05;
        $subTotalPrice = $finalTotalPrice / (1 + $taxRate);
        $taxAdminFee = $finalTotalPrice - $subTotalPrice;

        // Waktu kadaluarsa pembayaran (misal: 24 jam dari sekarang)
        $paymentExpiry = Carbon::now()->addHours(24);

        // ID Pesanan bisa diambil dari ID Booking itu sendiri, atau generate yang lebih kompleks
        $orderId = '#ER' . $booking->id . Carbon::now()->format('His'); // Contoh ID yang lebih unik per transaksi

        return view('pages.payment', compact(
            'booking', // Sekarang meneruskan objek booking
            'subTotalPrice', // Tetap teruskan jika perlu ditampilkan terpisah
            'taxAdminFee',   // Tetap teruskan jika perlu ditampilkan terpisah
            'finalTotalPrice',
            'paymentExpiry',
            'orderId'
        ));
    }

    // Metode lain untuk memproses konfirmasi pembayaran akan ditambahkan nanti
    // public function processPayment(Request $request, Booking $booking) { ... }
}

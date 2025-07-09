<?php
// app\Http\Controllers\PaymentController.php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\VehicleUnit;

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
        $subTotalPrice = $booking->sub_total_price;
        $taxAdminFee = $booking->tax_admin_fee;

        // Waktu kadaluarsa pembayaran (misal: 24 jam dari sekarang)
        $paymentExpiry = Carbon::now()->addHours(24);

        // ID Pesanan bisa diambil dari ID Booking itu sendiri, atau generate yang lebih kompleks
        $orderId = '#ER' . $booking->id . $booking->created_at->format('His');

        return view('pages.payment', compact(
            'booking',
            'subTotalPrice',
            'taxAdminFee',
            'finalTotalPrice',
            'paymentExpiry',
            'orderId'
        ));
    }

    /**
     * Memproses konfirmasi pembayaran untuk booking tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function confirmPayment(Request $request, Booking $booking): JsonResponse
    {
        // Validasi data yang masuk
        $request->validate([
            'payment_method' => 'required|string|in:bank_transfer,e_wallet,cash',
        ]);

        // Jika statusnya sudah 'confirmed' atau status lain yang menunjukkan pembayaran sudah selesai
        if ($booking->status === 'confirmed') {
            return response()->json([
                'message' => 'Pesanan ini sudah dikonfirmasi pembayarannya.',
                'booking_id' => $booking->id,
            ], 409);
        }

        try {
            DB::beginTransaction();

            // Buat entri pembayaran baru
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_method' => $request->input('payment_method'),
                'transaction_id' => 'TRX-' . time() . '-' . $booking->id,
                'payment_date' => Carbon::now(),
                'status' => 'pending', // Status pembayaran awalnya pending, menunggu verifikasi admin
            ]);

            // Perbarui status booking menjadi confirmed
            $booking->update(['status' => 'confirmed']);

            // PERUBAHAN DI SINI: Perbarui status unit kendaraan menjadi 'disewa'
            // Pastikan relasi vehicleUnit sudah dimuat, atau muat di sini jika belum.
            // Jika booking->vehicleUnit tidak pernah null, ini aman.
            if ($booking->vehicleUnit) {
                $booking->vehicleUnit->update(['status' => 'disewa']);
            }

            DB::commit(); // Mengakhiri transaksi jika semua berhasil

            return response()->json([
                'message' => 'Konfirmasi pembayaran berhasil diproses. Menunggu verifikasi admin.',
                'booking_id' => $booking->id,
                'payment_id' => $payment->id,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            // Catat error untuk debugging
            \Log::error('Error processing payment confirmation: ' . $e->getMessage(), ['booking_id' => $booking->id, 'user_id' => auth()->id()]);

            return response()->json([
                'message' => 'Gagal memproses pembayaran. Silakan coba lagi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

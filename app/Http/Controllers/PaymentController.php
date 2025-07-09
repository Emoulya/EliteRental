<?php
// app\Http\Controllers\PaymentController.php
namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\BookingService;

class PaymentController extends Controller
{
    protected $bookingService;

    // Inject BookingService melalui constructor
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

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

        try {
            // Panggil service untuk mengkonfirmasi pembayaran booking
            $payment = $this->bookingService->confirmBookingPayment($booking, $request->input('payment_method'));

            return response()->json([
                'message' => 'Konfirmasi pembayaran berhasil diproses. Menunggu verifikasi admin.',
                'booking_id' => $booking->id,
                'payment_id' => $payment->id,
            ], 200);
        } catch (\Exception $e) {
            // Tangani error yang mungkin dilempar dari service
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}

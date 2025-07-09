<?php
// app\Http\Controllers\BookingController.php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\JsonResponse;
use App\Services\BookingService;

class BookingController extends Controller
{
    protected $bookingService; // Deklarasikan properti

    // Inject BookingService melalui constructor
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Menyimpan ringkasan booking awal dan mengarahkan ke halaman detail booking.
     * Metode ini akan dipanggil via POST dari tombol "Pesan Sekarang".
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBookingSummary(StoreBookingRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $userId = Auth::id();

        try {
            // Panggil service untuk membuat booking
            $booking = $this->bookingService->createBooking($validatedData, $userId);

            // Mengembalikan respons JSON dengan ID booking
            return response()->json([
                'message' => 'Ringkasan pesanan berhasil dibuat!',
                'booking_id' => $booking->id,
            ]);
        } catch (\Exception $e) {
            // Tangani error yang mungkin dilempar dari service
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Menampilkan halaman detail booking berdasarkan ID booking.
     * Metode ini sekarang akan menggunakan Route Model Binding.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\View\View
     */
    public function show(Booking $booking)
    {
        // Pastikan booking memiliki relasi yang dimuat jika diperlukan di view
        $booking->load('user.customerProfile', 'vehicleUnit.vehicle');

        // Data yang dibutuhkan sudah ada di objek $booking
        return view('pages.booking-detail', compact('booking'));
    }

    /**
     * Memperbarui catatan khusus pada booking yang sudah ada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateNotes(Request $request, Booking $booking): JsonResponse
    {
        $request->validate([
            'notes' => 'nullable|string|max:1000',
        ]);

        $booking->notes = $request->input('notes');
        $booking->save();

        return response()->json([
            'message' => 'Catatan berhasil diperbarui.',
            'booking_id' => $booking->id,
        ]);
    }
}

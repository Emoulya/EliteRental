<?php
// app\Http\Controllers\BookingController.php
namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleUnit;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{
    /**
     * Menyimpan ringkasan booking awal dan mengarahkan ke halaman detail booking.
     * Metode ini akan dipanggil via POST dari tombol "Pesan Sekarang".
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeBookingSummary(StoreBookingRequest $request): JsonResponse
    {
        // Data sudah divalidasi oleh StoreBookingRequest
        $validatedData = $request->validated();

        $user = Auth::user();
        $vehicleUnit = VehicleUnit::where('license_plate', $validatedData['plate_number'])
            ->where('vehicle_id', $validatedData['vehicle_id'])
            ->firstOrFail();

        // Ambil quantity dan pastikan di-cast ke integer
        $quantity = (int) $validatedData['quantity'];

        $durationType = $validatedData['duration_type'];
        $subTotalPrice = $validatedData['total_price'];

        // Perhitungan tanggal sewa dan pengembalian
        $startDate = Carbon::now()->startOfDay()->addDay();
        $endDate = clone $startDate;

        switch ($durationType) {
            case 'daily':
                $endDate->addDays($quantity);
                break;
            case 'weekly':
                $endDate->addWeeks($quantity);
                break;
            case 'monthly':
                $endDate->addMonths($quantity);
                break;
        }

        $taxAdminRate = 0.05;
        $taxAdminFee = $subTotalPrice * $taxAdminRate;
        $finalTotalPrice = $subTotalPrice + $taxAdminFee;

        // Buat entri booking di database dengan status 'pending'
        $booking = Booking::create([
            'user_id' => $user->id,
            'vehicle_unit_id' => $vehicleUnit->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_price' => $finalTotalPrice,
            'sub_total_price' => $subTotalPrice,
            'tax_admin_fee' => $taxAdminFee,
            'status' => 'pending',
            'notes' => null,
            'duration_type' => $durationType,
            'quantity' => $quantity,
        ]);

        // Opsional: Ubah status unit kendaraan menjadi 'disewa_sementara' atau 'pending_booking'
        // untuk mencegah double booking sebelum pembayaran
        // $vehicleUnit->update(['status' => 'pending_booking']); // Perlu tambahkan status ini di enum migrasi VehicleUnit

        // Mengembalikan respons JSON dengan ID booking
        return response()->json([
            'message' => 'Ringkasan pesanan berhasil dibuat!',
            'booking_id' => $booking->id,
        ]);
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

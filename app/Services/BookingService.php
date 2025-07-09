<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\VehicleUnit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService
{
    /**
     * Membuat booking baru berdasarkan data yang divalidasi.
     *
     * @param array $data Data booking yang divalidasi dari request.
     * @param int $userId ID pengguna yang melakukan booking.
     * @return \App\Models\Booking
     * @throws \Exception
     */
    public function createBooking(array $data, int $userId): Booking
    {
        // Temukan unit kendaraan yang relevan
        $vehicleUnit = VehicleUnit::where('license_plate', $data['plate_number'])
            ->where('vehicle_id', $data['vehicle_id'])
            ->firstOrFail();

        // Ambil quantity dan pastikan di-cast ke integer
        $quantity = (int) $data['quantity'];
        $durationType = $data['duration_type'];
        $subTotalPrice = $data['total_price'];

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

        // Hitung pajak dan biaya admin
        $taxAdminRate = 0.05;
        $taxAdminFee = $subTotalPrice * $taxAdminRate;
        $finalTotalPrice = $subTotalPrice + $taxAdminFee;

        // Mulai transaksi database
        DB::beginTransaction();
        try {
            // Buat entri booking di database
            $booking = Booking::create([
                'user_id' => $userId,
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

            // Perbarui status unit kendaraan menjadi 'pending_booking'
            $vehicleUnit->status = 'pending_booking';
            $vehicleUnit->save();

            DB::commit();

            return $booking;
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan transaksi jika terjadi kesalahan
            Log::error('Gagal membuat booking: ' . $e->getMessage(), ['user_id' => $userId, 'data' => $data]);
            throw new \Exception('Terjadi kesalahan saat memproses pesanan Anda. Silakan coba lagi.');
        }
    }

    /**
     * Memproses konfirmasi pembayaran untuk booking tertentu.
     *
     * @param  \App\Models\Booking  $booking
     * @param  string  $paymentMethod
     * @return \App\Models\Payment
     * @throws \Exception
     */
    public function confirmBookingPayment(Booking $booking, string $paymentMethod): Payment
    {
        // Jika statusnya sudah 'confirmed' atau status lain yang menunjukkan pembayaran sudah selesai
        if ($booking->status === 'confirmed') {
            throw new \Exception('Pesanan ini sudah dikonfirmasi pembayarannya.');
        }

        DB::beginTransaction();
        try {
            // Buat entri pembayaran baru
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_method' => $paymentMethod,
                'transaction_id' => 'TRX-' . time() . '-' . $booking->id,
                'payment_date' => Carbon::now(),
                'status' => 'pending',
            ]);

            // Perbarui status booking menjadi confirmed
            $booking->update(['status' => 'confirmed']);

            if ($booking->vehicleUnit) {
                $booking->vehicleUnit->update(['status' => 'disewa']);
            }

            DB::commit();

            return $payment;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing payment confirmation: ' . $e->getMessage(), ['booking_id' => $booking->id]);
            throw new \Exception('Gagal memproses pembayaran. Silakan coba lagi.');
        }
    }
}

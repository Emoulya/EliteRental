<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleUnit;

class StoreBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya user yang terautentikasi yang bisa membuat booking
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'plate_number' => [
                'required',
                'string',
                // Validasi bahwa plat nomor ada dan statusnya 'tersedia' untuk vehicle_id yang diberikan
                function ($attribute, $value, $fail) {
                    $vehicleId = $this->input('vehicle_id');
                    $unit = VehicleUnit::where('license_plate', $value)
                        ->where('vehicle_id', $vehicleId)
                        ->first();

                    if (!$unit) {
                        $fail('Plat nomor tidak ditemukan untuk kendaraan ini.');
                    } elseif ($unit->status !== 'tersedia') {
                        $fail('Unit kendaraan dengan plat nomor ini tidak tersedia.');
                    }
                },
            ],
            'duration_type' => 'required|string|in:daily,weekly,monthly',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            // Tambahan jika Anda ingin start_date dan end_date juga dikirim dari form awal (disarankan)
            // 'start_date' => 'required|date|after_or_equal:today',
            // 'end_date' => 'required|date|after:start_date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'vehicle_id.required' => 'ID kendaraan wajib diisi.',
            'vehicle_id.exists' => 'Kendaraan tidak ditemukan.',
            'plate_number.required' => 'Plat nomor wajib dipilih.',
            'duration_type.required' => 'Tipe durasi sewa wajib dipilih.',
            'duration_type.in' => 'Tipe durasi sewa tidak valid.',
            'quantity.required' => 'Kuantitas sewa wajib diisi.',
            'quantity.integer' => 'Kuantitas harus berupa angka.',
            'quantity.min' => 'Kuantitas minimal adalah 1.',
            'total_price.required' => 'Total harga wajib diisi.',
            'total_price.numeric' => 'Total harga harus berupa angka.',
            'total_price.min' => 'Total harga tidak boleh negatif.',
            // 'start_date.required' => 'Tanggal mulai sewa wajib diisi.',
            // 'start_date.after_or_equal' => 'Tanggal mulai sewa tidak boleh di masa lalu.',
            // 'end_date.required' => 'Tanggal selesai sewa wajib diisi.',
            // 'end_date.after' => 'Tanggal selesai sewa harus setelah tanggal mulai sewa.',
        ];
    }
}

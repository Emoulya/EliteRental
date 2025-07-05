<?php
// app\Http\Requests\UpdateVehicleRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Sesuaikan dengan logika otorisasi Anda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'required|string',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'color' => 'required|string|max:255',
            'passenger_capacity' => 'nullable|integer|min:1',
            'transmission_type' => 'nullable|string|in:manual,automatic',
            'fuel_type' => 'nullable|string|in:bensin,diesel,listrik',
            'features' => 'nullable|string|in:ac,air_vent,helmet,open_tub',
            'daily_price' => 'required|integer|min:0',
            'original_daily_price' => 'nullable|integer|min:0|gte:daily_price',
            'weekly_price' => 'nullable|integer|min:0',
            'monthly_price' => 'nullable|integer|min:0',
            'engine_type' => 'nullable|string|max:255',
            'max_power' => 'nullable|string|max:255',
            'max_torque' => 'nullable|string|max:255',
            'transmission' => 'nullable|string|max:255',
            'fuel_efficiency' => 'nullable|string|max:255',
            'length' => 'nullable|integer|min:0',
            'width' => 'nullable|integer|min:0',
            'height' => 'nullable|integer|min:0',
            'wheelbase' => 'nullable|integer|min:0',
            'tank_capacity' => 'nullable|integer|min:0',
            'additional_features' => 'nullable|array',
            'additional_features.*' => 'string',
            'elite_features' => 'nullable|array',
            'elite_features.*' => 'string',
            'long_description' => 'nullable|string',
            'rental_requirements' => 'nullable|string',
            'rental_terms' => 'nullable|string',
            'deposit_payment_info' => 'nullable|string',
            'prohibitions' => 'nullable|string',
            // Gambar tidak harus diisi saat update, tapi jika diisi harus valid
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'existing_gallery_images' => 'nullable|array', // Untuk menghandle gambar galeri yang sudah ada
        ];
    }

    public function messages(): array
    {
        return [
            'daily_price.required' => 'Harga sewa per hari wajib diisi.',
            'year.max' => 'Tahun produksi tidak boleh melebihi tahun sekarang.',
            'original_daily_price.gte' => 'Harga normal harus lebih besar atau sama dengan harga sewa per hari.',
        ];
    }
}

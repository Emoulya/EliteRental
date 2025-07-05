<?php
// app/Http/Requests/StoreVehicleUnitRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'license_plate' => ['required', 'string', 'max:255', 'unique:vehicle_units', 'regex:/^[A-Z]{1,2}\s[0-9]{1,5}\s?[A-Z]{0,3}$/i'],
            'status' => 'required|string|in:tersedia,disewa,maintenance,unavailable',
        ];
    }

    public function messages(): array
    {
        return [
            'license_plate.unique' => 'Nomor plat kendaraan ini sudah terdaftar untuk unit lain.',
            'license_plate.required' => 'Nomor plat kendaraan wajib diisi.',
            'license_plate.regex' => 'Format nomor plat kendaraan tidak valid. Contoh: B 1234 ABC atau B 1234.',
            'status.required' => 'Status ketersediaan wajib diisi.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}

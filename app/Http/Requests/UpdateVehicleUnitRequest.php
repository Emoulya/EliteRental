<?php
// app/Http/Requests/UpdateVehicleUnitRequest.php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleUnitRequest extends FormRequest
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
        // Ambil ID unit kendaraan dari route parameter untuk mengabaikannya dari unique check
        $unitId = $this->route('unit');

        return [
            'license_plate' => ['required', 'string', 'max:255', Rule::unique('vehicle_units')->ignore($unitId)],
            'status' => 'required|string|in:tersedia,disewa,maintenance,unavailable',
        ];
    }

    public function messages(): array
    {
        return [
            'license_plate.unique' => 'Nomor plat kendaraan ini sudah terdaftar untuk unit lain.',
            'license_plate.required' => 'Nomor plat kendaraan wajib diisi.',
            'status.required' => 'Status ketersediaan wajib diisi.',
            'status.in' => 'Status yang dipilih tidak valid.',
        ];
    }
}

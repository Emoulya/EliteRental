<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateCustomerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Hanya user yang terautentikasi yang bisa memperbarui profilnya sendiri
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = Auth::id(); // Ambil ID user yang sedang login

        return [
            // Aturan untuk data User
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Pastikan email unik kecuali email user yang sedang diupdate
                Rule::unique('users')->ignore($userId),
            ],
            // Aturan untuk data CustomerProfile
            'phone_number' => ['nullable', 'string', 'max:20', 'regex:/^[0-9\-\(\)\+\s]+$/'],
            'ktp_number' => [
                'nullable',
                'string',
                'max:20',
                // Pastikan KTP unik kecuali KTP user yang sedang diupdate
                Rule::unique('customer_profiles')->ignore($userId, 'user_id'),
            ],
            'sim_number' => [
                'nullable',
                'string',
                'max:20',
                // Pastikan SIM unik kecuali SIM user yang sedang diupdate
                Rule::unique('customer_profiles')->ignore($userId, 'user_id'),
            ],
            'full_address' => ['nullable', 'string', 'max:500'],
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
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'phone_number.regex' => 'Format nomor telepon tidak valid.',
            'ktp_number.unique' => 'Nomor KTP ini sudah terdaftar.',
            'sim_number.unique' => 'Nomor SIM ini sudah terdaftar.',
        ];
    }
}

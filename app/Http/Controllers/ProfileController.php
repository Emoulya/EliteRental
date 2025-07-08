<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Requests\UpdateCustomerProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Load customerProfile jika ada
        $user = $request->user()->load('customerProfile');

        return view('pages.profile-edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateCustomerProfileRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update data User
        $user->fill($request->only('name', 'email'));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update atau buat CustomerProfile
        $user->customerProfile()->updateOrCreate(
            ['user_id' => $user->id], // Cari berdasarkan user_id
            $request->only('phone_number', 'ktp_number', 'sim_number', 'full_address') // Data yang akan diupdate/dibuat
        );

        return redirect()->route('profile.edit')->with('status', 'profile-updated'); // Redirect dengan pesan sukses
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

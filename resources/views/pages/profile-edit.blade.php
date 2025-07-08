{{-- resources/views/pages/profile-edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Profil - Elite Rental')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Informasi Profil
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Perbarui informasi profil akun Anda dan alamat email.
                    </p>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')
                        <div>
                            <x-forms.input-label for="name" value="Nama Lengkap" />
                            <x-forms.text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-forms.input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="email" value="Email" />
                            <x-forms.text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-forms.input-error :messages="$errors->get('email')" class="mt-2" />
                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800">
                                        Alamat email Anda belum terverifikasi.
                                        <button form="send-verification"
                                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Klik di sini untuk mengirim ulang email verifikasi.
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            Tautan verifikasi baru telah dikirim ke alamat email Anda.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 pt-4">Informasi Tambahan Pelanggan</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Lengkapi detail yang diperlukan untuk proses rental.
                        </p>
                        <div>
                            <x-forms.input-label for="phone_number" value="Nomor Telepon" />
                            <x-forms.text-input id="phone_number" name="phone_number" type="text"
                                class="mt-1 block w-full" :value="old('phone_number', $user->customerProfile->phone_number ?? '')" autocomplete="tel" />
                            <x-forms.input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="ktp_number" value="Nomor KTP" />
                            <x-forms.text-input id="ktp_number" name="ktp_number" type="text" class="mt-1 block w-full"
                                :value="old('ktp_number', $user->customerProfile->ktp_number ?? '')" autocomplete="off" />
                            <x-forms.input-error :messages="$errors->get('ktp_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="sim_number" value="Nomor SIM" />
                            <x-forms.text-input id="sim_number" name="sim_number" type="text" class="mt-1 block w-full"
                                :value="old('sim_number', $user->customerProfile->sim_number ?? '')" autocomplete="off" />
                            <x-forms.input-error :messages="$errors->get('sim_number')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="full_address" value="Alamat Lengkap" />
                            <x-forms.textarea-input id="full_address" name="full_address" rows="3"
                                class="mt-1 block w-full">{{ old('full_address', $user->customerProfile->full_address ?? '') }}</x-forms.textarea-input>
                            <x-forms.input-error :messages="$errors->get('full_address')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-buttons.primary-button>{{ __('Simpan') }}</x-buttons.primary-button>
                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bagian untuk update password --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Perbarui Kata Sandi
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                    </p>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <div>
                            <x-forms.input-label for="current_password" value="Kata Sandi Saat Ini" />
                            <x-forms.text-input id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="current-password" />
                            <x-forms.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="password" value="Kata Sandi Baru" />
                            <x-forms.text-input id="password" name="password" type="password" class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <x-forms.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>
                        <div>
                            <x-forms.input-label for="password_confirmation" value="Konfirmasi Kata Sandi" />
                            <x-forms.text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />
                            <x-forms.input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-buttons.primary-button>{{ __('Simpan') }}</x-buttons.primary-button>
                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Tersimpan.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bagian untuk hapus akun --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">
                        Hapus Akun
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum
                        menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                    </p>
                    <x-danger-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Hapus Akun') }}</x-danger-button>
                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')

                            <h2 class="text-lg font-medium text-gray-900">
                                Apakah Anda yakin ingin menghapus akun Anda?
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Mohon
                                masukkan kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara
                                permanen.
                            </p>
                            <div class="mt-6">
                                <x-forms.input-label for="password" value="Kata Sandi" class="sr-only" />
                                <x-forms.text-input id="password" name="password" type="password"
                                    class="mt-1 block w-3/4" placeholder="Kata Sandi" />
                                <x-forms.input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                            </div>
                            <div class="mt-6 flex justify-end">
                                <x-buttons.secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Batal') }}
                                </x-buttons.secondary-button>
                                <x-danger-button class="ms-3">
                                    {{ __('Hapus Akun') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
@endsection

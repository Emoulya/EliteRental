{{-- resources\views\pages\booking-detail.blade.php --}}
@extends('layouts.app')

@section('title', 'Elite Rental - Detail Booking')

@section('content')
    <section class="bg-white py-4 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-custom hover:text-gold">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('vehicles.index') }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">Kendaraan</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            {{-- Menggunakan objek booking untuk mendapatkan vehicle ID --}}
                            <a href="{{ route('vehicles.show_public', $booking->vehicleUnit->vehicle->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">
                                {{ $booking->vehicleUnit->vehicle->brand }}
                                {{ $booking->vehicleUnit->vehicle->model }}
                            </a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-navy md:ml-2">Detail Booking</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    {{-- Asumsi Anda memiliki komponen booking-timeline --}}
    <x-public.booking-timeline :currentStep="1" />

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Informasi Penyewa
                    </h2>

                    @php
                        $user = $booking->user;
                        $customerProfile = $user->customerProfile;
                        $isProfileComplete =
                            $customerProfile &&
                            $customerProfile->phone_number &&
                            $customerProfile->ktp_number &&
                            $customerProfile->sim_number &&
                            $customerProfile->full_address;
                    @endphp

                    @if (!$isProfileComplete)
                        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Peringatan!</p>
                            <p class="text-sm">Data profil Anda belum lengkap. Mohon lengkapi <a
                                    href="{{ route('profile.edit') }}"
                                    class="font-semibold underline hover:text-yellow-800">di sini</a> sebelum melanjutkan ke
                                pembayaran.</p>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap:</label>
                                <p class="text-navy font-semibold">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon:</label>
                                <p class="text-navy font-semibold">{{ $customerProfile->phone_number ?? '-' }}</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email:</label>
                            <p class="text-navy font-semibold">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. KTP:</label>
                            <p class="text-navy font-semibold">{{ $customerProfile->ktp_number ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap:</label>
                            <p class="text-navy font-semibold">{{ $customerProfile->full_address ?? '-' }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. SIM:</label>
                            <p class="text-navy font-semibold">{{ $customerProfile->sim_number ?? '-' }}</p>
                        </div>

                        {{-- PERBAIKAN DI SINI: Mengubah Catatan Khusus menjadi textarea-input --}}
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan
                                Khusus:</label>
                            <x-forms.textarea-input id="notes" name="notes" rows="3"
                                placeholder="Masukkan catatan khusus (opsional)">{{ old('notes', $booking->notes) }}</x-forms.textarea-input>
                        </div>
                    </div>
                </div>

                {{-- Informasi Kendaraan --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Detail Kendaraan
                    </h2>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                            <img src="{{ $booking->vehicleUnit->vehicle->main_image ? asset('storage/' . $booking->vehicleUnit->vehicle->main_image) : asset('placeholder.svg?height=96&width=96&text=' . urlencode($booking->vehicleUnit->vehicle->model)) }}"
                                alt="{{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}"
                                class="w-full h-full object-cover rounded-lg" />
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800 text-lg">
                                {{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}
                            </h3>
                            <p class="text-sm text-gray-600">
                                {{ ucwords(str_replace('-', ' ', $booking->vehicleUnit->vehicle->category)) }} •
                                {{ $booking->vehicleUnit->vehicle->year }} •
                                {{ $booking->vehicleUnit->vehicle->passenger_capacity }} Penumpang •
                                {{ ucfirst($booking->vehicleUnit->vehicle->transmission_type) }} •
                                Warna {{ $booking->vehicleUnit->vehicle->color }}
                            </p>
                            <div class="flex items-center space-x-2 mt-1">
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
                                <span
                                    class="bg-gray-100 text-xs px-2 py-1 rounded">{{ $booking->vehicleUnit->license_plate }}</span>
                            </div>
                        </div>
                    </div>
                    {{-- Anda bisa menambahkan lebih banyak detail kendaraan di sini jika diperlukan --}}
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Ringkasan Pembayaran
                    </h2>

                    <div class="space-y-3 mb-6">
                        @php
                            // Ambil total harga final dari booking
                            $finalTotalPrice = $booking->total_price;
                            // Asumsikan biaya admin 5% dari sub total
                            // Maka, subTotal = finalTotal / (1 + taxRate)
                            $taxRate = 0.05;
                            $subTotalPrice = $finalTotalPrice / (1 + $taxRate);
                            $taxAdminFee = $finalTotalPrice - $subTotalPrice;

                            // Mengambil duration_type dan quantity langsung dari objek $booking
                            $currentDurationType = $booking->duration_type;
                            $currentQuantity = $booking->quantity;

                            $durationLabelSingular = '';
                            $durationLabelPlural = '';

                            // Dapatkan harga per unit dari $subTotalPrice dibagi $currentQuantity
                            $pricePerUnit = $currentQuantity > 0 ? $subTotalPrice / $currentQuantity : 0;

                            switch ($currentDurationType) {
                                case 'daily':
                                    $durationLabelSingular = 'hari';
                                    $durationLabelPlural = 'Hari';
                                    break;
                                case 'weekly':
                                    $durationLabelSingular = 'minggu';
                                    $durationLabelPlural = 'Minggu';
                                    break;
                                case 'monthly':
                                    $durationLabelSingular = 'bulan';
                                    $durationLabelPlural = 'Bulan';
                                    break;
                                default:
                                    $durationLabelSingular = 'unit'; // Fallback jika tidak dikenali
                                    $durationLabelPlural = 'Unit';
                                    break;
                            }
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Sewa (per {{ $durationLabelSingular }})</span>
                            <span class="font-medium">Rp {{ number_format($pricePerUnit, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">{{ $currentQuantity }} {{ $durationLabelPlural }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Sewa</span>
                            <span class="font-medium">{{ $booking->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Pengembalian</span>
                            <span class="font-medium">{{ $booking->end_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sub Total</span>
                            <span class="font-medium">Rp {{ number_format($subTotalPrice, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pajak & Biaya Admin</span>
                            <span class="font-medium">Rp {{ number_format($taxAdminFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-slate-800">Total Pembayaran</span>
                                <span class="text-lg font-bold text-gold">Rp
                                    {{ number_format($finalTotalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <button id="continueButton"
                        class="w-full bg-gold hover:bg-yellow-600 text-navy font-bold py-3 px-4 rounded-lg transition duration-200"
                        @if (!$isProfileComplete) disabled @endif>
                        <i class="fas fa-arrow-right mr-2"></i>
                        Lanjutkan ke Pembayaran
                    </button>
                    @if (!$isProfileComplete)
                        <p class="text-red-500 text-sm mt-2 text-center">Mohon lengkapi profil untuk melanjutkan.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const continueButton = document.getElementById('continueButton');
            const isProfileComplete = {{ $isProfileComplete ? 'true' : 'false' }};
            const bookingId = {{ $booking->id }}; // Ambil ID booking dari Blade

            if (continueButton) {
                continueButton.addEventListener("click", async function(e) { // Tambahkan 'async'
                    e.preventDefault();

                    if (!isProfileComplete) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Profil Belum Lengkap',
                            text: 'Anda harus melengkapi data profil terlebih dahulu untuk melanjutkan pembayaran.',
                            confirmButtonColor: '#F4B000'
                        });
                        return;
                    }

                    // --- Logika untuk menyimpan Catatan Khusus sebelum redirect ---
                    showLoading('Menyimpan catatan dan melanjutkan...'); // Tampilkan loading

                    const notesInput = document.getElementById('notes');
                    const currentNotes = notesInput ? notesInput.value : '';

                    const formData = new FormData();
                    formData.append('notes', currentNotes);
                    formData.append('_token', '{{ csrf_token() }}'); // Tambahkan CSRF token
                    formData.append('_method', 'PUT'); // Gunakan metode PUT untuk update

                    try {
                        const response = await fetch(
                        `/booking/${bookingId}/update-notes`, { // Route baru untuk update catatan
                            method: 'POST',
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            const errorData = await response.json();
                            let errorMessage = errorData.message || 'Gagal menyimpan catatan.';
                            if (response.status === 422 && errorData.errors) {
                                errorMessage = Object.values(errorData.errors).flat().join('<br>');
                            }
                            showError(`Terjadi kesalahan:<br>${errorMessage}`);
                            return;
                        }

                        // Jika berhasil disimpan, lanjutkan ke halaman pembayaran
                        window.location.href = `{{ route('payment.show', $booking->id) }}`;

                    } catch (error) {
                        console.error('Error saat menyimpan catatan:', error);
                        showError('Gagal menyimpan catatan. Silakan coba lagi.');
                    } finally {
                        Swal.close(); // Tutup loading
                    }
                });
            }
        });
    </script>
@endpush

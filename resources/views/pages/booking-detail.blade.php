@extends('layouts.app')

@section('title', 'Elite Rental - Detail Booking')

@section('content')
    <section class="bg-white pt-20 pb-4 border-b">
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
                            <a href="{{ route('vehicles.show_public', $vehicle->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">{{ $vehicle->brand }}
                                {{ $vehicle->model }}</a>
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

    <div class="bg-white border-b">
        <div class="container mx-auto px-4 py-6">
            <div class="flex items-center justify-center space-x-8">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-navy text-white rounded-full flex items-center justify-center text-sm font-bold">
                        1
                    </div>
                    <span class="ml-3 text-navy font-medium">Detail Booking</span>
                </div>
                <div class="w-16 h-0.5 bg-gray-300"></div>
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">
                        2
                    </div>
                    <span class="ml-3 text-gray-500">Pembayaran</span>
                </div>
                <div class="w-16 h-0.5 bg-gray-300"></div>
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">
                        3
                    </div>
                    <span class="ml-3 text-gray-500">Konfirmasi</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Informasi Penyewa
                    </h2>

                    <form id="bookingForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <x-forms.text-input type="text" name="full_name" placeholder="Masukkan nama lengkap"
                                    required />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon *</label>
                                <x-forms.text-input type="tel" name="phone_number" placeholder="Masukkan nomor telepon"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <x-forms.text-input type="email" name="email" placeholder="Masukkan email" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. KTP *</label>
                            <x-forms.text-input type="text" name="ktp_number" placeholder="Masukkan nomor KTP"
                                required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <x-forms.textarea-input rows="3" name="address" placeholder="Masukkan alamat lengkap"
                                required></x-forms.textarea-input>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. SIM *</label>
                            <x-forms.text-input type="text" name="sim_number" placeholder="Masukkan nomor SIM"
                                required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Khusus</label>
                            <x-forms.textarea-input rows="3" name="special_notes"
                                placeholder="Masukkan catatan khusus (opsional)"></x-forms.textarea-input>
                        </div>

                        <div class="text-sm text-gray-500 mt-4">
                            <p>* Wajib diisi</p>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Ringkasan Booking
                    </h2>

                    <div class="border-b pb-4 mb-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : asset('placeholder.svg?height=60&width=60&text=' . urlencode($vehicle->model)) }}"
                                    alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">
                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ ucwords(str_replace('-', ' ', $vehicle->category)) }} • {{ $vehicle->year }} •
                                    {{ $vehicle->passenger_capacity }} Penumpang •
                                    {{ ucfirst($vehicle->transmission_type) }} • Warna {{ $vehicle->color }}
                                </p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
                                    <span class="bg-gray-100 text-xs px-2 py-1 rounded">{{ $plateNumber }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        @php
                            $durationLabelSingular = '';
                            $durationLabelPlural = '';
                            switch ($durationType) {
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
                                    $durationLabelSingular = 'unit';
                                    $durationLabelPlural = 'Unit';
                                    break;
                            }
                        @endphp
                        <div class="flex justify-between">
                            <span class="text-gray-600">Harga Sewa (per {{ $durationLabelSingular }})</span>
                            <span class="font-medium">Rp
                                {{ number_format($subTotalPrice / $quantity, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">{{ $quantity }} {{ $durationLabelPlural }}</span>
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
                        class="w-full bg-gold hover:bg-yellow-600 text-navy font-bold py-3 px-4 rounded-lg transition duration-200">
                        <i class="fas fa-arrow-right mr-2"></i>
                        Lanjutkan ke Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bookingForm');
            const continueButton = document.getElementById('continueButton');

            if (continueButton) {
                continueButton.addEventListener("click", function(e) {
                    e.preventDefault();

                    // Mengumpulkan data dari form
                    const formData = new FormData(form);
                    // Menambahkan data booking yang sudah ada
                    formData.append('vehicle_id', {{ $vehicle->id }});
                    formData.append('plate_number', '{{ $plateNumber }}');
                    formData.append('duration_type', '{{ $durationType }}');
                    formData.append('quantity', {{ $quantity }});
                    formData.append('total_price', {{ $subTotalPrice }});

                    // Membuat query string
                    const queryString = new URLSearchParams(formData).toString();

                    // URL untuk halaman pembayaran
                    const paymentUrl = `{{ route('payment.show') }}?${queryString}`;

                    // Menggunakan metode validasi HTML5 bawaan browser
                    if (!form.checkValidity()) {
                        alert("Mohon lengkapi semua field yang wajib diisi.");
                        form.reportValidity(); // Meminta browser menampilkan tooltip validasi
                    } else {
                        // Jika form valid, arahkan ke halaman pembayaran
                        window.location.href = paymentUrl;
                    }
                });
            }
        });
    </script>
@endpush

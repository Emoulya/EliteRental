{{-- resources/views/pages/confirmation.blade.php --}}
@extends('layouts.app')

@section('title', 'Elite Rental - Konfirmasi Pesanan')

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
                            {{-- Gunakan $booking->vehicleUnit->vehicle->id --}}
                            <a href="{{ route('vehicles.show_public', $booking->vehicleUnit->vehicle->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">{{ $booking->vehicleUnit->vehicle->brand }}
                                {{ $booking->vehicleUnit->vehicle->model }}</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            {{-- Gunakan $booking->id --}}
                            <a href="{{ route('booking.show', $booking->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">Detail Booking</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            {{-- Gunakan $booking->id --}}
                            <a href="{{ route('payment.show', $booking->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">Pembayaran</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-navy md:ml-2">Konfirmasi</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <x-public.booking-timeline :currentStep="3" />

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8 mb-6 text-center">
                <div class="w-20 h-20 bg-green-500 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-check text-3xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 mb-2">
                    Pesanan Berhasil Dibuat!
                </h1>
                <p class="text-gray-600 mb-4">
                    Terima kasih telah mempercayakan kebutuhan rental
                    kendaraan Anda kepada Elite Rental
                </p>
                <div class="bg-gold text-white px-6 py-2 rounded-full inline-block">
                    <span class="font-semibold">ID Pesanan: {{ $orderId }}</span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                Status Pesanan
                            </h3>
                            <p class="text-sm text-green-600 font-medium">
                                Menunggu Verifikasi
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-yellow-500 text-white rounded-full flex items-center justify-center">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                Status Pembayaran
                            </h3>
                            <p class="text-sm text-yellow-600 font-medium">
                                Menunggu Pembayaran
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-purple-500 text-white rounded-full flex items-center justify-center">
                            <i class="fas fa-car"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800">
                                Status Kendaraan
                            </h3>
                            <p class="text-sm text-purple-600 font-medium">
                                Disiapkan
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">
                            Detail Kendaraan
                        </h2>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img src="{{ $booking->vehicleUnit->vehicle->main_image ? asset('storage/' . $booking->vehicleUnit->vehicle->main_image) : asset('placeholder.svg?height=60&width=60&text=' . urlencode($booking->vehicleUnit->vehicle->model)) }}"
                                    alt="{{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">
                                    {{ $booking->vehicleUnit->vehicle->brand }}
                                    {{ $booking->vehicleUnit->vehicle->model }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ ucwords(str_replace('-', ' ', $booking->vehicleUnit->vehicle->category)) }} •
                                    {{ $booking->vehicleUnit->vehicle->year }} •
                                    {{ $booking->vehicleUnit->vehicle->passenger_capacity ?? '-' }} Penumpang •
                                    {{ ucfirst($booking->vehicleUnit->vehicle->transmission_type ?? '-') }}
                                </p>
                                <div class="flex items-center space-x-2 mt-2">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                        <i
                                            class="fas fa-users mr-1"></i>{{ $booking->vehicleUnit->vehicle->passenger_capacity ?? '-' }}
                                        Penumpang
                                    </span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                        <i
                                            class="fas fa-cogs mr-1"></i>{{ ucfirst($booking->vehicleUnit->vehicle->transmission_type ?? '-') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Plat Nomor:</span>
                                <p class="font-semibold">{{ $booking->vehicleUnit->license_plate }}</p>
                            </div>
                            <div>
                                <span class="text-gray-600">Warna:</span>
                                <p class="font-semibold">{{ $booking->vehicleUnit->vehicle->color }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">
                            Periode Sewa
                        </h2>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-calendar-alt text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Tanggal Mulai
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->start_date->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-calendar-check text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Tanggal Selesai
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->end_date->translatedFormat('l, d F Y') }}
                                    </p>
                                </div>
                            </div>
                            @php
                                $durationLabelSingular = '';
                                $durationLabelPlural = '';
                                switch ($booking->duration_type) {
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
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-clock text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Durasi
                                    </p>
                                    <p class="font-semibold">{{ $booking->quantity }} {{ $durationLabelPlural }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">
                            Lokasi Pengambilan & Pengembalian
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-green-500 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Lokasi Pengambilan
                                    </p>
                                    <p class="font-semibold">
                                        {{ $pickupLocationName }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $pickupLocationAddress }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Jam: {{ $pickupLocationHours }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-red-500 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Lokasi Pengembalian
                                    </p>
                                    <p class="font-semibold">
                                        {{ $returnLocationName }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        {{ $returnLocationAddress }}
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Jam: {{ $returnLocationHours }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">
                            Data Penyewa
                        </h2>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-user text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Nama Lengkap
                                    </p>
                                    <p class="font-semibold">{{ $booking->user->name ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        No. Telepon
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->user->customerProfile->phone_number ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Email
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->user->email ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-id-card text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        No. KTP
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->user->customerProfile->ktp_number ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-id-card-alt text-navy"></i>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        No. SIM
                                    </p>
                                    <p class="font-semibold">
                                        {{ $booking->user->customerProfile->sim_number ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-bold text-slate-800 mb-4">
                            Ringkasan Pembayaran
                        </h2>
                        <div class="space-y-3">
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
                            <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-info-circle text-yellow-600"></i>
                                    <p class="text-sm text-yellow-700">
                                        <strong>Metode Pembayaran:</strong>
                                        {{ ucfirst($paymentMethod ?? 'N/A') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mt-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="printOrder()"
                    class="flex items-center justify-center px-6 py-3 bg-navy text-white rounded-lg hover:bg-blue-700 transition duration-200">

                    <i class="fas fa-print mr-2"></i>
                    Cetak Pesanan
                </button>
                <button onclick="downloadPDF()"
                    class="flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-file-pdf mr-2"></i>
                    Download PDF
                </button>
                <button onclick="sendEmail()"
                    class="flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-envelope mr-2"></i>
                    Kirim Email
                </button>
                <button onclick="goHome()"
                    class="flex items-center justify-center px-6 py-3 bg-gold text-white rounded-lg hover:bg-yellow-600 transition duration-200">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Beranda
                </button>
            </div>
        </div>

        <div class="bg-navy text-white rounded-lg shadow-md p-6 mt-6">

            <div class="text-center">
                <h2 class="text-xl font-bold mb-2">Butuh Bantuan?</h2>
                <p class="mb-4">
                    Tim customer service kami siap membantu Anda 24/7
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:+622112345678"
                        class="flex items-center justify-center px-6 py-3 bg-white text-navy rounded-lg hover:bg-gray-100 transition duration-200">

                        <i class="fas fa-phone mr-2"></i>
                        Hubungi Kami
                    </a>
                    <a href="https://wa.me/6281234567890"
                        class="flex items-center justify-center px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Print order function (global)
        window.printOrder = function() {
            window.print();
        };

        // Download PDF function (global)
        window.downloadPDF = function() {
            alert(
                "Fitur download PDF akan segera tersedia. Sementara ini Anda dapat menggunakan fitur cetak."
            );
        };

        // Send email function (global)
        window.sendEmail = function() {
            alert(
                "Konfirmasi pesanan telah dikirim ke email Anda: {{ $booking->user->email ?? 'email@example.com' }}"
            );
        };

        // Go to home function (global)
        window.goHome = function() {
            alert("Mengarahkan ke halaman beranda...");
            window.location.href = '{{ route('home') }}';
        };

        // Auto-refresh order status (simulation)
        function checkOrderStatus() {
            // Simulate checking order status
            setTimeout(() => {
                // Anda dapat memperbarui status di sini berdasarkan respons API yang sebenarnya
                console.log("Checking order status...");
            }, 5000);
        }

        // Initialize page
        document.addEventListener("DOMContentLoaded", function() {
            checkOrderStatus();

            // Show success animation for the check icon
            const successIconContainer = document.querySelector('.w-20.h-20.bg-green-500.rounded-full');
            if (successIconContainer) {
                const style = document.createElement("style");
                style.textContent = `
                @keyframes bounce {
                    0%, 20%, 50%, 80%, 100% {
                        transform: translateY(0);
                    }
                    40% {
                        transform: translateY(-10px);
                    }
                    60% {
                        transform: translateY(-5px);
                    }
                }
                `;
                document.head.appendChild(style);
                successIconContainer.querySelector('.fas.fa-check').style.animation = "bounce 1s ease-in-out";
            }
        });
    </script>
@endpush

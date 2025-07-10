<?php
// EliteRental/resources/views/pages/transactions/index.blade.php
?>
@extends('layouts.app')

@section('title', 'Transaksi Saya - Elite Rental')

@section('content')
    <section class="bg-white py-4 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-common.breadcrumbs :links="[
                ['url' => route('home'), 'label' => 'Beranda', 'icon' => 'fas fa-home'],
                ['label' => 'Transaksi Saya', 'active' => true],
            ]" />
        </div>
    </section>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-navy mb-8 text-center">
            Riwayat Transaksi Saya
        </h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            @forelse ($bookings as $booking)
                <div class="border-b pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        {{-- Bagian Kiri: Detail Kendaraan --}}
                        <div class="flex items-center space-x-4 mb-4 md:mb-0 w-full md:w-3/5 lg:w-2/3">
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <img src="{{ $booking->vehicleUnit->vehicle->main_image ? asset('storage/' . $booking->vehicleUnit->vehicle->main_image) : asset('placeholder.svg?height=80&width=80&text=' . urlencode($booking->vehicleUnit->vehicle->model)) }}"
                                    alt="{{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div class="flex-grow">
                                <h2 class="font-bold text-navy text-xl mb-1">
                                    {{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}
                                </h2>
                                @php
                                    $orderId = '#ER' . $booking->id . $booking->created_at->format('His');
                                @endphp
                                <p class="text-sm text-gray-700 mb-2">
                                    {{-- ID Pesanan menjadi link --}}
                                    ID Pesanan:
                                    <a href="{{ route('booking.confirmation', $booking->id) }}"
                                        class="font-semibold text-gold hover:underline">
                                        {{ $orderId }}
                                    </a>
                                </p>
                                <p class="text-sm text-gray-600 mb-1">
                                    Plat Nomor: <span
                                        class="font-medium text-navy">{{ $booking->vehicleUnit->license_plate }}</span>
                                </p>
                                <p class="text-sm text-gray-600 mb-1">
                                    Durasi: <span class="font-medium">{{ $booking->quantity }}
                                        {{ ucfirst($booking->duration_type) }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Sewa: <span class="font-medium">{{ $booking->start_date->format('d M Y') }}</span> -
                                    <span class="font-medium">{{ $booking->end_date->format('d M Y') }}</span>
                                </p>
                            </div>
                        </div>

                        {{-- Bagian Kanan: Harga dan Status --}}
                        <div class="text-right flex flex-col items-end w-full md:w-2/5 lg:w-1/3 mt-4 md:mt-0">
                            <p class="text-gray-600 text-sm mb-1">Tanggal Pesanan:</p>
                            <p class="text-navy font-semibold text-base mb-3">
                                {{ $booking->created_at->translatedFormat('d F Y, H:i') }}
                            </p>
                            <p class="text-lg font-bold text-gold mb-2">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            @php
                                $statusColor =
                                    [
                                        'pending' => 'text-yellow-600',
                                        'confirmed' => 'text-blue-600',
                                        'rented' => 'text-purple-600',
                                        'completed' => 'text-green-600',
                                        'cancelled' => 'text-red-600',
                                    ][$booking->status] ?? 'text-gray-600';

                                $statusBgColor =
                                    [
                                        'pending' => 'bg-yellow-100',
                                        'confirmed' => 'bg-blue-100',
                                        'rented' => 'bg-purple-100',
                                        'completed' => 'bg-green-100',
                                        'cancelled' => 'bg-red-100',
                                    ][$booking->status] ?? 'bg-gray-100';

                                $statusText =
                                    [
                                        'pending' => 'Menunggu Pembayaran',
                                        'confirmed' => 'Pembayaran Dikonfirmasi',
                                        'rented' => 'Sedang Disewa',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ][$booking->status] ?? ucfirst($booking->status);
                            @endphp
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }} {{ $statusBgColor }} mb-3">
                                {{ $statusText }}
                            </span>
                            {{-- PERUBAHAN DI SINI: Tombol 'Lihat Detail' hanya muncul jika status BUKAN 'confirmed' --}}
                            @if ($booking->status !== 'confirmed')
                                <a href="{{ route('booking.show', $booking->id) }}"
                                    class="mt-2 text-sm text-gold hover:underline font-semibold flex items-center">
                                    Lihat Detail
                                    <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 text-lg py-8">Anda belum memiliki transaksi.</p>
            @endforelse

            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Memeriksa apakah ada pesan error dari session
            @if (session('error_message'))
                // Memanggil fungsi showError dari app.js
                showError("{{ session('error_message') }}");
            @endif
        });
    </script>
@endpush

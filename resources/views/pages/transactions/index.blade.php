{{-- resources/views/pages/transactions/index.blade.php --}}
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
            Transaksi Saya
        </h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            @forelse ($bookings as $booking)
                <div class="border-b pb-4 mb-4 last:border-b-0 last:pb-0 last:mb-0">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div class="flex items-center space-x-4 mb-4 md:mb-0">
                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img src="{{ $booking->vehicleUnit->vehicle->main_image ? asset('storage/' . $booking->vehicleUnit->vehicle->main_image) : asset('placeholder.svg?height=80&width=80&text=' . urlencode($booking->vehicleUnit->vehicle->model)) }}"
                                    alt="{{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div>
                                <h2 class="font-bold text-navy text-lg">
                                    {{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}
                                </h2>
                                <p class="text-sm text-gray-600">
                                    Plat Nomor: <span class="font-medium">{{ $booking->vehicleUnit->license_plate }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Durasi: <span class="font-medium">{{ $booking->quantity }}
                                        {{ ucfirst($booking->duration_type) }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    Sewa: <span class="font-medium">{{ $booking->start_date->format('d M Y') }}</span> -
                                    <span class="font-medium">{{ $booking->end_date->format('d M Y') }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="text-right flex flex-col items-end">
                            @php
                                $statusColor =
                                    [
                                        'pending' => 'text-yellow-600',
                                        'confirmed' => 'text-blue-600',
                                        'rented' => 'text-purple-600',
                                        'completed' => 'text-green-600',
                                        'cancelled' => 'text-red-600',
                                    ][$booking->status] ?? 'text-gray-600';

                                $statusText =
                                    [
                                        'pending' => 'Menunggu Pembayaran',
                                        'confirmed' => 'Pembayaran Dikonfirmasi',
                                        'rented' => 'Sedang Disewa',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                    ][$booking->status] ?? ucfirst($booking->status);
                            @endphp
                            <p class="text-lg font-bold text-gold mb-2">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            <span
                                class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }} bg-{{ explode('-', $statusColor)[0] }}-100">
                                {{ $statusText }}
                            </span>
                            <a href="{{ route('booking.show', $booking->id) }}"
                                class="mt-2 text-sm text-gold hover:underline">
                                Lihat Detail
                            </a>
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

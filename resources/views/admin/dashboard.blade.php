{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Admin - Elite Rental')

@section('page_title', 'Dashboard')

@section('content')
    <!-- Top Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-navy"> {{ $revenueThisMonth }} </div>
                    <div class="text-gray-custom">
                        Pendapatan Bulan Ini
                    </div>
                    <div class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>+12.5%
                    </div>
                </div>
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-money-bill-wave text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-navy"> {{ $totalBookings }} </div>
                    <div class="text-gray-custom">Total Booking</div>
                    <div class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>+8.2%
                    </div>
                </div>
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-navy"> {{ $totalVehicles }} </div>
                    <div class="text-gray-custom">Total Kendaraan</div>
                    <div class="text-sm text-blue-600 mt-1">
                        <i class="fas fa-plus mr-1"></i>2 baru
                    </div>
                </div>
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-car text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold text-navy"> {{ $totalCustomers }} </div>
                    <div class="text-gray-custom">Pelanggan Aktif</div>
                    <div class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>+15.3%
                    </div>
                </div>
                <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Vehicle Status and Recent Activities Combined -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Vehicle Status -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-navy mb-6">
                Status Kendaraan
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Tersedia</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-navy font-semibold mr-2">{{ $availableUnits }}</span>
                        <span class="text-sm text-gray-500">({{ $availablePercentage }}%)</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-green-500 h-2 rounded-full" style="width: {{ $availablePercentage }}%"></div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Disewa</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-navy font-semibold mr-2">{{ $rentedUnits }}</span>
                        <span class="text-sm text-gray-500">({{ $rentedPercentage }}%)</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-500 h-2 rounded-full" style="width: {{ $rentedPercentage }}%"></div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Maintenance</span>
                    </div>
                    <div class="flex items-center">
                        <span class="text-navy font-semibold mr-2">{{ $maintenanceUnits }}</span>
                        <span class="text-sm text-gray-500">({{ $maintenancePercentage }}%)</span>
                    </div>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $maintenancePercentage }}%"></div>
                </div>
            </div>

            <!-- Donut Chart Alternative -->
            <div class="mt-6 flex justify-center">
                <div class="relative w-32 h-32">
                    <!-- Background circle for total -->
                    <div class="absolute inset-0 rounded-full border-8 border-gray-200"></div>

                    <!-- Available slice -->
                    <div class="absolute inset-0 rounded-full border-8 border-green-500"
                        style="
                                clip-path: polygon(
                                    50% 0%,
                                    50% 50%,
                                    100% 50%,
                                    100% 0%
                                );
                                transform: rotate(0deg);
                                border-color: #22c55e; /* green-500 */
                                --tw-border-opacity: 1;
                            ">
                    </div>
                    <div class="absolute inset-0 rounded-full border-8 border-green-500"
                        style="
                                clip-path: polygon(
                                    0% 0%,
                                    50% 0%,
                                    50% 50%,
                                    0% 50%
                                );
                                transform: rotate(0deg);
                                border-color: #22c55e; /* green-500 */
                                --tw-border-opacity: 1;
                            ">
                    </div>
                    <div class="absolute inset-0 rounded-full border-8 border-green-500"
                        style="
                                clip-path: polygon(
                                    0% 50%,
                                    50% 50%,
                                    50% 100%,
                                    0% 100%
                                );
                                transform: rotate(0deg);
                                border-color: #22c55e; /* green-500 */
                                --tw-border-opacity: 1;
                            ">
                    </div>

                    <!-- Rented slice -->
                    <div class="absolute inset-0 rounded-full border-8 border-red-500"
                        style="
                                clip-path: polygon(
                                    50% 50%,
                                    100% 50%,
                                    100% 100%,
                                    50% 100%
                                );
                                transform: rotate(
                                    135deg
                                ); /* Adjusted to start after green */
                                border-color: #ef4444; /* red-500 */
                                --tw-border-opacity: 1;
                            ">
                    </div>

                    <!-- Maintenance slice -->
                    <div class="absolute inset-0 rounded-full border-8 border-yellow-500"
                        style="
                                clip-path: polygon(
                                    50% 0%,
                                    100% 0%,
                                    100% 50%,
                                    50% 50%
                                ); /* Adjusted to be a smaller slice */
                                transform: rotate(
                                    235deg
                                ); /* Adjusted to start after red */
                                border-color: #eab308; /* yellow-500 */
                                --tw-border-opacity: 1;
                            ">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-lg font-bold text-navy"> {{ $totalUnits }} </div>
                            <div class="text-xs text-gray-500">
                                Total
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-navy">
                    Aktivitas Terbaru
                </h3>
                <a href="#" class="text-gold hover:text-yellow-600 text-sm font-medium">Lihat Semua</a>
            </div>
            <div class="space-y-4">
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-navy font-medium">
                            Booking baru dari Budi Santoso
                        </div>
                        <div class="text-xs text-gray-custom">
                            Toyota Avanza - 3 hari
                        </div>
                        <div class="text-xs text-gray-400">
                            2 menit yang lalu
                        </div>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-navy font-medium">
                            Pembayaran diterima
                        </div>
                        <div class="text-xs text-gray-custom">
                            Rp 900.000 - Honda Vario
                        </div>
                        <div class="text-xs text-gray-400">
                            15 menit yang lalu
                        </div>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-navy font-medium">
                            Kendaraan dikembalikan
                        </div>
                        <div class="text-xs text-gray-custom">
                            Toyota Fortuner - B 5678 DEF
                        </div>
                        <div class="text-xs text-gray-400">
                            1 jam yang lalu
                        </div>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-red-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-navy font-medium">
                            Maintenance dijadwalkan
                        </div>
                        <div class="text-xs text-gray-custom">
                            Honda Vario - Service rutin
                        </div>
                        <div class="text-xs text-gray-400">
                            2 jam yang lalu
                        </div>
                    </div>
                </div>
                <div class="flex items-start space-x-3">
                    <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                    <div class="flex-1">
                        <div class="text-sm text-navy font-medium">
                            Review baru diterima
                        </div>
                        <div class="text-xs text-gray-custom">
                            5 bintang - Toyota Avanza
                        </div>
                        <div class="text-xs text-gray-400">
                            3 jam yang lalu
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

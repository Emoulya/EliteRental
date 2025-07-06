@extends('layouts.app')

@section('title', $vehicle->brand . ' ' . $vehicle->model . ' - Elite Rental')

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
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-navy md:ml-2">{{ $vehicle->brand }}
                                {{ $vehicle->model }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="relative">
                        <img id="mainImage"
                            src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : asset('placeholder.svg?height=400&width=600&text=' . urlencode($vehicle->model)) }}"
                            alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                            class="w-full h-96 object-cover rounded-lg shadow-lg" />
                        <div class="absolute top-4 left-4">
                            @if ($vehicle->available_units_count > 0)
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tersedia
                                    ({{ $vehicle->available_units_count }} Unit)</span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tidak
                                    Tersedia</span>
                            @endif
                        </div>
                        <div class="absolute top-4 right-4">
                            <label class="ui-like">
                                <input type="checkbox" />
                                <div class="like">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="">
                                        <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                                        <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M20.808,11.079C19.829,16.132,12,20.5,12,20.5s-7.829-4.368-8.808-9.421C2.227,6.1,5.066,3.5,8,3.5a4.444,4.444,0,0,1,4,2,4.444,4.444,0,0,1,4-2C18.934,3.5,21.773,6.1,20.808,11.079Z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-2">
                        {{-- Tampilkan gambar utama sebagai thumbnail pertama --}}
                        <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : asset('placeholder.svg?height=100&width=150&text=' . urlencode($vehicle->model)) }}"
                            alt="Main Image"
                            class="thumbnail w-full h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-gold transition duration-300 active-thumbnail" />
                        @if ($vehicle->gallery_images)
                            @foreach ($vehicle->gallery_images as $imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Gallery Image"
                                    class="thumbnail w-full h-20 object-cover rounded cursor-pointer border-2 border-transparent hover:border-gold transition duration-300" />
                            @endforeach
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        @if ($vehicle->passenger_capacity)
                            <div class="flex items-center p-3 bg-white rounded-lg shadow">
                                <i class="fas fa-users text-gold text-xl mr-3"></i>
                                <div>
                                    <div class="font-semibold text-navy">{{ $vehicle->passenger_capacity }} Penumpang
                                    </div>
                                    <div class="text-sm text-gray-custom">Kapasitas maksimal</div>
                                </div>
                            </div>
                        @endif
                        @if ($vehicle->transmission_type)
                            <div class="flex items-center p-3 bg-white rounded-lg shadow">
                                <i class="fas fa-cog text-gold text-xl mr-3"></i>
                                <div>
                                    <div class="font-semibold text-navy">{{ ucfirst($vehicle->transmission_type) }}
                                    </div>
                                    <div class="text-sm text-gray-custom">Transmisi</div>
                                </div>
                            </div>
                        @endif
                        @if ($vehicle->fuel_type)
                            <div class="flex items-center p-3 bg-white rounded-lg shadow">
                                <i class="fas fa-gas-pump text-gold text-xl mr-3"></i>
                                <div>
                                    <div class="font-semibold text-navy">{{ ucfirst($vehicle->fuel_type) }}</div>
                                    <div class="text-sm text-gray-custom">Bahan bakar</div>
                                </div>
                            </div>
                        @endif
                        @if ($vehicle->features)
                            @php
                                $featureIcon = '';
                                switch ($vehicle->features) {
                                    case 'ac':
                                        $featureIcon = 'fas fa-snowflake';
                                        break;
                                    case 'air_vent':
                                        $featureIcon = 'fas fa-wind';
                                        break;
                                    case 'helmet':
                                        $featureIcon = 'fas fa-helmet-safety';
                                        break;
                                    case 'open_tub':
                                        $featureIcon = 'fas fa-truck-pickup';
                                        break;
                                    default:
                                        $featureIcon = 'fas fa-check-circle';
                                        break;
                                }
                            @endphp
                            <div class="flex items-center p-3 bg-white rounded-lg shadow">
                                <i class="{{ $featureIcon }} text-gold text-xl mr-3"></i>
                                <div>
                                    <div class="font-semibold text-navy">
                                        {{ ucwords(str_replace('_', ' ', $vehicle->features)) }}</div>
                                    <div class="text-sm text-gray-custom">Fitur Utama</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-navy mb-2">
                            {{ $vehicle->brand }} {{ $vehicle->model }} <span class="font-normal text-gray-custom">|
                                {{ $vehicle->year }}</span>
                        </h1>
                        <p class="text-lg text-gray-custom mb-4">
                            {{ ucwords(str_replace('-', ' ', $vehicle->category)) }}
                            @if ($vehicle->passenger_capacity)
                                • {{ $vehicle->passenger_capacity }} Penumpang
                            @endif
                            @if ($vehicle->transmission_type)
                                • {{ ucfirst($vehicle->transmission_type) }}
                            @endif
                            @if ($vehicle->color)
                                • Warna {{ ucfirst($vehicle->color) }}
                            @endif
                        </p>

                        <x-public.vehicle-rental-calculator :vehicle="$vehicle" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="border-b border-gray-200">
                    <nav class="flex space-x-8 px-6" aria-label="Tabs">
                        <button
                            class="tab-button py-4 px-1 border-b-2 border-gold text-gold font-medium text-sm whitespace-nowrap"
                            data-tab="description">
                            Deskripsi
                        </button>
                        <button
                            class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap"
                            data-tab="specifications">
                            Spesifikasi
                        </button>
                        <button
                            class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap"
                            data-tab="features">
                            Fitur & Fasilitas
                        </button>
                        <button
                            class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 font-medium text-sm whitespace-nowrap"
                            data-tab="terms">
                            Syarat & Ketentuan
                        </button>
                    </nav>
                </div>

                <div class="p-6">
                    <div id="description" class="tab-content">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            Tentang {{ $vehicle->brand }} {{ $vehicle->model }}
                        </h3>
                        <div class="prose max-w-none text-gray-custom">
                            <p class="mb-4">
                                {{ $vehicle->long_description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                        </div>
                    </div>

                    <div id="specifications" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            Spesifikasi Lengkap
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-navy mb-3">Mesin & Performa</h4>
                                <div class="space-y-2 text-gray-custom">
                                    <div class="flex justify-between">
                                        <span>Tipe Mesin:</span>
                                        <span>{{ $vehicle->engine_type ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tenaga Maksimal:</span>
                                        <span>{{ $vehicle->max_power ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Torsi Maksimal:</span>
                                        <span>{{ $vehicle->max_torque ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Transmisi:</span>
                                        <span>{{ $vehicle->transmission ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Konsumsi BBM:</span>
                                        <span>{{ $vehicle->fuel_efficiency ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h4 class="font-semibold text-navy mb-3">Dimensi & Kapasitas</h4>
                                <div class="space-y-2 text-gray-custom">
                                    <div class="flex justify-between">
                                        <span>Panjang:</span>
                                        <span>{{ $vehicle->length ? number_format($vehicle->length, 0, ',', '.') . ' mm' : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Lebar:</span>
                                        <span>{{ $vehicle->width ? number_format($vehicle->width, 0, ',', '.') . ' mm' : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tinggi:</span>
                                        <span>{{ $vehicle->height ? number_format($vehicle->height, 0, ',', '.') . ' mm' : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Wheelbase:</span>
                                        <span>{{ $vehicle->wheelbase ? number_format($vehicle->wheelbase, 0, ',', '.') . ' mm' : '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Kapasitas Tangki:</span>
                                        <span>{{ $vehicle->tank_capacity ? $vehicle->tank_capacity . ' liter' : '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="features" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            Fitur & Fasilitas
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            @if ($vehicle->additional_features && count($vehicle->additional_features) > 0)
                                <div>
                                    <h4 class="font-semibold text-navy mb-3">Interior & Eksterior</h4>
                                    <ul class="space-y-2 text-gray-custom">
                                        @foreach ($vehicle->additional_features as $feature)
                                            <li class="flex items-center">
                                                <i class="fas fa-check text-gold mr-2"></i>
                                                {{ ucwords(str_replace('_', ' ', $feature)) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-gray-500">Tidak ada fitur tambahan yang terdaftar.</p>
                            @endif

                            @if ($vehicle->elite_features && count($vehicle->elite_features) > 0)
                                <div>
                                    <h4 class="font-semibold text-navy mb-3">
                                        Fasilitas Tambahan dari Elite Rental
                                    </h4>
                                    <div class="grid md:grid-cols-3 gap-4">
                                        @foreach ($vehicle->elite_features as $eliteFeature)
                                            @php
                                                $featureName = ucwords(str_replace('_', ' ', $eliteFeature));
                                                $icon = '';

                                                // Map feature names to appropriate icons
                                                if (
                                                    str_contains(strtolower($eliteFeature), 'bbm') ||
                                                    str_contains(strtolower($eliteFeature), 'bahan bakar')
                                                ) {
                                                    $icon = 'fa-gas-pump';
                                                } elseif (
                                                    str_contains(strtolower($eliteFeature), 'toolkit') ||
                                                    str_contains(strtolower($eliteFeature), 'perkakas')
                                                ) {
                                                    $icon = 'fa-tools';
                                                } elseif (
                                                    str_contains(strtolower($eliteFeature), 'support') ||
                                                    str_contains(strtolower($eliteFeature), '24/7')
                                                ) {
                                                    $icon = 'fa-phone';
                                                } elseif (
                                                    str_contains(strtolower($eliteFeature), 'driver') ||
                                                    str_contains(strtolower($eliteFeature), 'sopir')
                                                ) {
                                                    $icon = 'fa-user-tie';
                                                } elseif (str_contains(strtolower($eliteFeature), 'wifi')) {
                                                    $icon = 'fa-wifi';
                                                } elseif (str_contains(strtolower($eliteFeature), 'air')) {
                                                    $icon = 'fa-fan';
                                                } else {
                                                    $icon = 'fa-check-circle';
                                                }
                                            @endphp
                                            <div class="flex items-center p-3 bg-gray-100 rounded-lg">
                                                <i class="fas {{ $icon }} text-gold text-xl mr-3"></i>
                                                <span class="text-gray-custom">{{ $featureName }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <p class="text-gray-500">Tidak ada fasilitas tambahan Elite Rental yang terdaftar.</p>
                            @endif
                        </div>
                    </div>

                    <div id="terms" class="tab-content hidden">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            Syarat & Ketentuan Sewa
                        </h3>
                        <div class="space-y-6">
                            <div>
                                <h4 class="font-semibold text-navy mb-3">Persyaratan Penyewa</h4>
                                <ul class="space-y-2 text-gray-custom">
                                    @if ($vehicle->rental_requirements)
                                        @foreach (explode("\n", $vehicle->rental_requirements) as $req)
                                            @if (trim($req))
                                                <li class="flex items-start">
                                                    <i class="fas fa-check text-gold mr-2 mt-1"></i>
                                                    {{ trim($req) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>Tidak ada persyaratan penyewa yang terdaftar.</li>
                                    @endif
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-semibold text-navy mb-3">Ketentuan Sewa</h4>
                                <ul class="space-y-2 text-gray-custom">
                                    @if ($vehicle->rental_terms)
                                        @foreach (explode("\n", $vehicle->rental_terms) as $term)
                                            @if (trim($term))
                                                <li class="flex items-start">
                                                    <i class="fas fa-info-circle text-gold mr-2 mt-1"></i>
                                                    {{ trim($term) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>Tidak ada ketentuan sewa yang terdaftar.</li>
                                    @endif
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-semibold text-navy mb-3">Deposit & Pembayaran</h4>
                                <ul class="space-y-2 text-gray-custom">
                                    @if ($vehicle->deposit_payment_info)
                                        @foreach (explode("\n", $vehicle->deposit_payment_info) as $info)
                                            @if (trim($info))
                                                <li class="flex items-start">
                                                    <i class="fas fa-money-bill text-gold mr-2 mt-1"></i>
                                                    {{ trim($info) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>Tidak ada informasi deposit/pembayaran yang terdaftar.</li>
                                    @endif
                                </ul>
                            </div>

                            <div>
                                <h4 class="font-semibold text-navy mb-3">Larangan</h4>
                                <ul class="space-y-2 text-gray-custom">
                                    @if ($vehicle->prohibitions)
                                        @foreach (explode("\n", $vehicle->prohibitions) as $proh)
                                            @if (trim($proh))
                                                <li class="flex items-start">
                                                    <i class="fas fa-times text-red-500 mr-2 mt-1"></i>
                                                    {{ trim($proh) }}
                                                </li>
                                            @endif
                                        @endforeach
                                    @else
                                        <li>Tidak ada larangan yang terdaftar.</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl font-bold text-navy mb-8 text-center">
                Kendaraan Serupa
            </h3>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($similarVehicles as $similarVehicle)
                    <x-vehicle-card :vehicle="$similarVehicle" />
                @empty
                    <p class="col-span-full text-center text-gray-custom">Tidak ada kendaraan serupa ditemukan.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Tab functionality
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach((button) => {
            button.addEventListener("click", () => {
                const tabId = button.getAttribute("data-tab");

                // Remove active classes
                tabButtons.forEach((btn) => {
                    btn.classList.remove("border-gold", "text-gold");
                    btn.classList.add(
                        "border-transparent",
                        "text-gray-500"
                    );
                });

                tabContents.forEach((content) => {
                    content.classList.add("hidden");
                });

                // Add active classes
                button.classList.remove(
                    "border-transparent",
                    "text-gray-500"
                );
                button.classList.add("border-gold", "text-gold");

                document.getElementById(tabId).classList.remove("hidden");
            });
        });

        // Image gallery functionality
        const thumbnails = document.querySelectorAll(".thumbnail");
        const mainImage = document.getElementById("mainImage");

        thumbnails.forEach((thumbnail) => {
            thumbnail.addEventListener("click", () => {
                let newSrc = thumbnail.src;
                if (newSrc.includes('/placeholder.svg')) {
                    newSrc = newSrc.replace(/height=\d+&width=\d+/, 'height=400&width=600');
                } else {
                    // Untuk gambar asli yang di-load dari storage, tidak perlu perubahan URL
                }
                mainImage.src = newSrc;

                // Remove active border from all thumbnails
                thumbnails.forEach((thumb) =>
                    thumb.classList.remove("border-gold", "active-thumbnail")
                );
                // Add active border to clicked thumbnail
                thumbnail.classList.add("border-gold", "active-thumbnail");
            });
        });

        // Set initial active thumbnail (main image)
        document.addEventListener('DOMContentLoaded', () => {
            const initialMainImageSrc = mainImage.src;
            thumbnails.forEach(thumbnail => {
                if (thumbnail.src === initialMainImageSrc) {
                    thumbnail.classList.add('border-gold', 'active-thumbnail');
                }
            });
        });
    </script>
@endpush

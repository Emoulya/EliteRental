{{-- resources\views\components\vehicle-card.blade.php --}}
<div class="vehicle-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300"
    data-category="{{ $vehicle->category }}" data-price="{{ $vehicle->daily_price }}"
    data-total-units="{{ $vehicle->total_units_count }}" data-available-units="{{ $vehicle->available_units_count }}">
    <div class="relative">
        {{-- Menggunakan helper asset('storage/...') untuk gambar yang disimpan di storage/app/public --}}
        <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : asset('placeholder.svg?height=200&width=300&text=' . urlencode($vehicle->brand . ' ' . $vehicle->model)) }}"
            alt="{{ $vehicle->brand }} {{ $vehicle->model }}" class="w-full h-48 object-cover"
            onerror="this.onerror=null;this.src='https://placehold.co/300x200/e0e0e0/5a5a5a?text={{ urlencode($vehicle->brand . ' ' . $vehicle->model) }}';" />
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
    <div class="p-6">
        <h3 class="text-xl font-bold text-navy mb-2">{{ $vehicle->brand }} {{ $vehicle->model }}</h3>
        <p class="text-gray-custom mb-3">
            {{ ucwords(str_replace('-', ' ', $vehicle->category)) }}
            @if ($vehicle->passenger_capacity)
                • {{ $vehicle->passenger_capacity }} Penumpang
            @endif
        </p>

        <div class="flex items-center justify-between mb-4">
            <div class="text-gold font-bold text-lg">
                Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}<span
                    class="text-sm text-gray-custom">/hari</span>
            </div>
            @if ($vehicle->original_daily_price && $vehicle->original_daily_price > $vehicle->daily_price)
                <div class="text-sm text-gray-500 line-through">
                    Rp {{ number_format($vehicle->original_daily_price, 0, ',', '.') }}
                </div>
            @endif
        </div>

        <div class="grid grid-cols-2 gap-2 mb-4 text-sm text-gray-custom">
            @if ($vehicle->passenger_capacity)
                <div class="flex items-center">
                    <i class="fas fa-users mr-2 text-gold"></i>
                    {{ $vehicle->passenger_capacity }} Penumpang
                </div>
            @endif
            <div class="flex items-center">
                <i class="fas fa-cog mr-2 text-gold"></i>
                {{ ucfirst($vehicle->transmission_type ?? '-') }}
            </div>
            <div class="flex items-center">
                <i class="fas fa-gas-pump mr-2 text-gold"></i>
                {{ ucfirst($vehicle->fuel_type ?? '-') }}
            </div>
            <div class="flex items-center">
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
                    <i class="{{ $featureIcon }} mr-2 text-gold"></i>
                    {{ ucwords(str_replace('_', ' ', $vehicle->features)) }}
                @else
                    <span class="text-gray-500">Tidak ada fitur utama</span>
                @endif
            </div>
        </div>

        <div class="flex space-x-2">
            @if ($vehicle->available_units_count > 0)
                <a href="{{ route('vehicles.show_public', $vehicle->id) }}"
                    class="flex-1 bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded text-center transition duration-300">
                    Sewa Sekarang
                </a>
            @else
                <button class="flex-1 bg-gray-400 text-white font-semibold py-2 px-4 rounded cursor-not-allowed"
                    disabled>
                    Tidak Tersedia
                </button>
            @endif
            <a href="{{ route('vehicles.show_public', $vehicle->id) }}"
                class="px-4 py-2 border border-gold text-gold hover:bg-gold hover:text-navy rounded transition duration-300 flex items-center justify-center">
                <i class="fas fa-info-circle"></i>
            </a>
        </div>
    </div>
</div>

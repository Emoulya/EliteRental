{{-- resources\views\components\vehicle-card.blade.php --}}
<div class="vehicle-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300"
    data-category="{{ $vehicle->category }}" data-price="{{ $vehicle->daily_price }}"
    data-availability="{{ $vehicle->status }}">
    <div class="relative">
        {{-- Menggunakan helper asset('storage/...') untuk gambar yang disimpan di storage/app/public --}}
        <img src="{{ asset('storage/' . $vehicle->main_image) }}" alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
            class="w-full h-48 object-cover"
            onerror="this.onerror=null;this.src='https://placehold.co/300x200/e0e0e0/5a5a5a?text={{ urlencode($vehicle->brand . ' ' . $vehicle->model) }}';" />
        <div class="absolute top-4 left-4">
            @if ($vehicle->status === 'tersedia')
                <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Tersedia</span>
            @elseif($vehicle->status === 'disewa')
                <span class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Disewa</span>
            @else
                {{-- Untuk status lain seperti 'maintenance', 'unavailable' --}}
                <span
                    class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold">{{ ucfirst($vehicle->status) }}</span>
            @endif
        </div>
        <div class="absolute top-4 right-4">
            <!-- icon love -->
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
            @if ($vehicle->category === 'pickup' && $vehicle->features && in_array('Angkut Barang', $vehicle->features))
                • Angkut Barang
            @endif
        </p>

        <div class="flex items-center justify-between mb-4">
            <div class="text-gold font-bold text-lg">
                Rp {{ number_format($vehicle->daily_price / 1000, 0, ',', '.') }}K<span
                    class="text-sm text-gray-custom">/hari</span>
            </div>
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
                {{ ucfirst($vehicle->transmission_type) }}
            </div>
            <div class="flex items-center">
                <i class="fas fa-gas-pump mr-2 text-gold"></i>
                {{ ucfirst ($vehicle->fuel_type) }}
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
            @if ($vehicle->status === 'tersedia')
                <button
                    class="flex-1 bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                    Sewa Sekarang
                </button>
            @else
                <button class="flex-1 bg-gray-400 text-white font-semibold py-2 px-4 rounded cursor-not-allowed"
                    disabled>
                    Tidak Tersedia
                </button>
            @endif
            <button
                class="px-4 py-2 border border-gold text-gold hover:bg-gold hover:text-navy rounded transition duration-300">
                <i class="fas fa-info-circle"></i>
            </button>
        </div>
    </div>
</div>

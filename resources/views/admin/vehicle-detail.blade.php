{{-- resources/views/admin/vehicle-detail.blade.php --}}
@extends('layouts.admin')

{{-- Mengatur judul tab browser (dari $title di admin.blade.php) --}}
@section('title', $vehicle->brand . ' ' . $vehicle->model . ' - Elite Rental')

{{-- Mengatur judul halaman utama yang akan ditampilkan oleh components.admin-header --}}
@section('page_title', 'Detail Kendaraan')


@section('content')
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                        <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : '/placeholder.svg?height=60&width=80&text=' . $vehicle->model }}"
                            alt="{{ $vehicle->brand }} {{ $vehicle->model }}" class="w-full h-full rounded-lg object-cover" />
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-navy">
                            {{ $vehicle->brand }} {{ $vehicle->model }}
                        </h3>
                        <p class="text-gray-500">{{ $vehicle->license_plate }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            @php
                                $statusColor =
                                    [
                                        'tersedia' => 'green',
                                        'disewa' => 'red',
                                        'maintenance' => 'yellow',
                                        'unavailable' => 'gray',
                                    ][$vehicle->status] ?? 'gray';
                            @endphp
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                {{ ucfirst($vehicle->status) }}
                            </span>
                            @if ($vehicle->category)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucwords(str_replace('-', ' ', $vehicle->category)) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                        class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </a>
                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Galeri Gambar
                    </h4>
                </div>
                <div class="p-6">
                    <div class="mb-4">
                        <img id="mainImage"
                            src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : '/placeholder.svg?height=300&width=500&text=' . $vehicle->model }}"
                            alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                            class="w-full h-90 rounded-lg object-cover" />
                    </div>
                    <div class="flex space-x-2 overflow-x-auto">
                        @if ($vehicle->gallery_images && count($vehicle->gallery_images) > 0)
                            @foreach ($vehicle->gallery_images as $imagePath)
                                <img src="{{ asset('storage/' . $imagePath) }}" alt="Gallery Image"
                                    class="w-20 h-16 rounded cursor-pointer hover:opacity-75 transition duration-300 flex-shrink-0"
                                    onclick="changeMainImage(this.src)" />
                            @endforeach
                        @else
                            <p class="text-gray-500">Tidak ada gambar galeri.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Spesifikasi Kendaraan
                    </h4>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tahun Produksi:</span>
                                <span class="font-medium text-navy">{{ $vehicle->year }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Warna:</span>
                                <span class="font-medium text-navy">{{ $vehicle->color }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kapasitas Penumpang:</span>
                                <span class="font-medium text-navy">{{ $vehicle->passenger_capacity ?? '-' }} Orang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Transmisi:</span>
                                <span
                                    class="font-medium text-navy">{{ ucfirst($vehicle->transmission_type ?? '-') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bahan Bakar:</span>
                                <span class="font-medium text-navy">{{ ucfirst($vehicle->fuel_type ?? '-') }}</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tipe Mesin:</span>
                                <span class="font-medium text-navy">{{ $vehicle->engine_type ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tenaga Maksimal:</span>
                                <span class="font-medium text-navy">{{ $vehicle->max_power ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Torsi Maksimal:</span>
                                <span class="font-medium text-navy">{{ $vehicle->max_torque ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Konsumsi BBM:</span>
                                <span class="font-medium text-navy">{{ $vehicle->fuel_efficiency ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Dimensi & Kapasitas
                    </h4>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                {{ $vehicle->length ?? '-' }}
                            </div>
                            <div class="text-gray-500 text-sm">
                                Panjang (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                {{ $vehicle->width ?? '-' }}
                            </div>
                            <div class="text-gray-500 text-sm">
                                Lebar (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                {{ $vehicle->height ?? '-' }}
                            </div>
                            <div class="text-gray-500 text-sm">
                                Tinggi (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                {{ $vehicle->tank_capacity ?? '-' }}
                            </div>
                            <div class="text-gray-500 text-sm">
                                Kapasitas Tangki (L)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Fitur & Fasilitas Tambahan
                    </h4>
                </div>
                <div class="p-6">
                    @if ($vehicle->additional_features && count($vehicle->additional_features) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($vehicle->additional_features as $additionalFeature)
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span
                                        class="text-gray-700">{{ ucwords(str_replace('_', ' ', $additionalFeature)) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada fitur tambahan yang terdaftar.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Fasilitas Elite Rental
                    </h4>
                </div>
                <div class="p-6">
                    @if ($vehicle->elite_features && count($vehicle->elite_features) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach ($vehicle->elite_features as $eliteFeature)
                                <div class="flex items-center">
                                    {{-- Sesuaikan ikon sesuai fitur --}}
                                    <i class="fas fa-star text-gold mr-2"></i>
                                    <span class="text-gray-700">{{ ucwords(str_replace('_', ' ', $eliteFeature)) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada fasilitas tambahan Elite Rental.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Deskripsi
                    </h4>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 leading-relaxed">
                        {{ $vehicle->long_description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Harga Sewa
                    </h4>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Per Hari:</span>
                        <div class="text-right">
                            <div class="text-xl font-bold text-navy">
                                Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}
                            </div>
                            @if ($vehicle->original_daily_price && $vehicle->original_daily_price > $vehicle->daily_price)
                                <div class="text-sm text-gray-500 line-through">
                                    Rp {{ number_format($vehicle->original_daily_price, 0, ',', '.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Per Minggu:</span>
                        <div class="text-xl font-bold text-navy">
                            Rp {{ number_format($vehicle->weekly_price ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Per Bulan:</span>
                        <div class="text-xl font-bold text-navy">
                            Rp {{ number_format($vehicle->monthly_price ?? 0, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Syarat & Ketentuan
                    </h4>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Persyaratan Penyewa:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            @if ($vehicle->rental_requirements)
                                @foreach (explode("\n", $vehicle->rental_requirements) as $req)
                                    @if (trim($req))
                                        <li>• {{ trim($req) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Tidak ada persyaratan penyewa yang terdaftar.</li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Ketentuan Sewa:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            @if ($vehicle->rental_terms)
                                @foreach (explode("\n", $vehicle->rental_terms) as $term)
                                    @if (trim($term))
                                        <li>• {{ trim($term) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Tidak ada ketentuan sewa yang terdaftar.</li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Informasi Deposit & Pembayaran:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            @if ($vehicle->deposit_payment_info)
                                @foreach (explode("\n", $vehicle->deposit_payment_info) as $info)
                                    @if (trim($info))
                                        <li>• {{ trim($info) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Tidak ada informasi deposit/pembayaran yang terdaftar.</li>
                            @endif
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Larangan Selama Sewa:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            @if ($vehicle->prohibitions)
                                @foreach (explode("\n", $vehicle->prohibitions) as $proh)
                                    @if (trim($proh))
                                        <li>• {{ trim($proh) }}</li>
                                    @endif
                                @endforeach
                            @else
                                <li>Tidak ada larangan yang terdaftar.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Fitur Utama Kendaraan
                    </h4>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        @if ($vehicle->features)
                            @php
                                $featureIcon = '';
                                $featureColorClass = '';
                                switch ($vehicle->features) {
                                    case 'ac':
                                        $featureIcon = 'fas fa-snowflake';
                                        $featureColorClass = 'bg-blue-100 text-blue-600';
                                        break;
                                    case 'air_vent':
                                        $featureIcon = 'fas fa-wind';
                                        $featureColorClass = 'bg-cyan-100 text-cyan-600';
                                        break;
                                    case 'helmet':
                                        $featureIcon = 'fas fa-helmet-safety';
                                        $featureColorClass = 'bg-yellow-100 text-yellow-600';
                                        break;
                                    case 'open_tub':
                                        $featureIcon = 'fas fa-truck-pickup';
                                        $featureColorClass = 'bg-green-100 text-green-600';
                                        break;
                                    default:
                                        $featureIcon = 'fas fa-check-circle';
                                        $featureColorClass = 'bg-gray-100 text-gray-600';
                                        break;
                                }
                            @endphp
                            <div
                                class="w-16 h-16 {{ $featureColorClass }} rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="{{ $featureIcon }} text-2xl"></i>
                            </div>
                            <div class="text-lg font-semibold {{ explode(' ', $featureColorClass)[1] }} mb-2">
                                {{ ucwords(str_replace('_', ' ', $vehicle->features)) }}
                            </div>
                        @else
                            <p class="text-gray-500">Tidak ada fitur utama yang terdaftar.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Status Ketersediaan
                    </h4>
                </div>
                <div class="p-6">
                    <div class="text-center">
                        @php
                            $statusColorClass =
                                [
                                    'tersedia' => 'bg-green-100 text-green-600',
                                    'disewa' => 'bg-red-100 text-red-600',
                                    'maintenance' => 'bg-yellow-100 text-yellow-600',
                                    'unavailable' => 'bg-gray-100 text-gray-600',
                                ][$vehicle->status] ?? 'bg-gray-100 text-gray-600';

                            $statusIconClass =
                                [
                                    'tersedia' => 'fas fa-check-circle',
                                    'disewa' => 'fas fa-times-circle',
                                    'maintenance' => 'fas fa-tools',
                                    'unavailable' => 'fas fa-ban',
                                ][$vehicle->status] ?? 'fas fa-info-circle';
                        @endphp
                        <div
                            class="w-16 h-16 {{ $statusColorClass }} rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="{{ $statusIconClass }} text-2xl"></i>
                        </div>
                        <div class="text-lg font-semibold {{ explode(' ', $statusColorClass)[1] }} mb-2">
                            {{ ucfirst($vehicle->status) }}
                        </div>
                        <div class="text-sm text-gray-500">
                            @if ($vehicle->status == 'tersedia')
                                Siap untuk disewa
                            @elseif($vehicle->status == 'disewa')
                                Sedang dalam penyewaan
                            @elseif($vehicle->status == 'maintenance')
                                Sedang dalam perawatan
                            @elseif($vehicle->status == 'unavailable')
                                Tidak tersedia untuk disewa
                            @else
                                Status tidak diketahui
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Fungsi untuk mengganti gambar utama di galeri
        function changeMainImage(src) {
            document.getElementById("mainImage").src = src;
        }

        // Handle semua form hapus (SweetAlert2)
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // cegah submit langsung

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data kendaraan akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e3342f',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Memanggil fungsi showCustomMessage dari custom-message.blade.php
                        showCustomMessage('Menghapus kendaraan...', 'info');
                        form.submit(); // Lanjutkan pengiriman form jika dikonfirmasi
                    }
                });
            });
        });
    </script>
@endpush

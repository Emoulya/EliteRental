{{-- resources/views/admin/vehicle-detail.blade.php --}}
@extends('layouts.admin')

{{-- Mengatur judul tab browser (dari $title di admin.blade.php) --}}
@section('title', $vehicle->brand . ' ' . $vehicle->model . ' - Elite Rental')

{{-- Mengatur judul halaman utama yang akan ditampilkan oleh components.admin-header --}}
@section('page_title', 'Detail Model Kendaraan')


@section('content')
    @if (session('success_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showSuccess(@json(session('success_message')));
            });
        </script>
    @endif

    @if (session('error_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showError(@json(session('error_message')));
            });
        </script>
    @endif

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
                            {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->year }})
                        </h3>
                        <p class="text-gray-500">{{ ucwords(str_replace('-', ' ', $vehicle->category)) }} |
                            {{ $vehicle->color }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            {{-- Menampilkan jumlah unit yang tersedia dan total --}}
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                {{ $vehicle->units->where('status', 'tersedia')->count() }} Tersedia
                            </span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $vehicle->units->count() }} Total Unit
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}?_referrer=detail"
                        class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Model
                    </a>
                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                            <i class="fas fa-trash mr-2"></i>
                            Hapus Model
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
        </div>
    </div>

    {{-- MANAJEMEN UNIT KENDARAAN --}}
    <div class="bg-white rounded-lg shadow mt-6 p-6">
        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">
            Manajemen Unit Kendaraan (Plat Nomor)
        </h4>

        {{-- Formulir Tambah Unit Kendaraan Baru --}}
        <h5 class="font-semibold text-navy mb-3">Tambah Unit Baru:</h5>
        <form id="addUnitForm" action="{{ route('admin.vehicles.units.store', $vehicle->id) }}" method="POST"
            class="space-y-4 mb-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                <x-forms.text-input label="Nomor Plat Kendaraan" id="new_license_plate" name="license_plate" required
                    placeholder="Contoh: B 1234 ABC" value="{{ old('license_plate') }}" />
                <x-forms.select-input label="Status Unit" id="new_unit_status" name="status" required>
                    <option value="tersedia" @selected(old('status') == 'tersedia')>Tersedia</option>
                    <option value="disewa" @selected(old('status') == 'disewa')>Disewa</option>
                    <option value="maintenance" @selected(old('status') == 'maintenance')>Maintenance</option>
                    <option value="unavailable" @selected(old('status') == 'unavailable')>Tidak Tersedia</option>
                </x-forms.select-input>
                <div>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 w-full">
                        <i class="fas fa-plus mr-2"></i> Tambah Unit
                    </button>
                </div>
            </div>
            @error('license_plate')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </form>

        {{-- Daftar Unit Kendaraan --}}
        <h5 class="font-semibold text-navy mb-3">Daftar Unit Tersedia:</h5>
        @forelse ($vehicle->units as $unit)
            <div class="flex justify-between items-center bg-light-gray p-4 rounded-lg shadow-sm mb-3">
                <div>
                    <p class="text-lg font-semibold text-navy">{{ $unit->license_plate }}</p>
                    @php
                        $unitStatusColor =
                            [
                                'tersedia' => 'green',
                                'disewa' => 'red',
                                'maintenance' => 'yellow',
                                'unavailable' => 'gray',
                            ][$unit->status] ?? 'gray';
                    @endphp
                    <span
                        class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $unitStatusColor }}-100 text-{{ $unitStatusColor }}-800">
                        {{ ucfirst($unit->status) }}
                    </span>
                </div>
                <div class="flex space-x-2">
                    {{-- Tombol Edit Unit --}}
                    <button type="button" class="text-green-600 hover:text-green-900 edit-unit-btn p-1"
                        data-unit-id="{{ $unit->id }}" data-license-plate="{{ $unit->license_plate }}"
                        data-status="{{ $unit->status }}" title="Edit Unit">
                        <i class="fas fa-edit"></i>
                    </button>

                    {{-- Form Hapus Unit --}}
                    <form
                        action="{{ route('admin.vehicles.units.destroy', ['vehicle' => $vehicle->id, 'unit' => $unit->id]) }}"
                        method="POST" class="delete-unit-form inline">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="text-red-600 hover:text-red-900 p-1 delete-unit-btn"
                            title="Hapus Unit" data-license-plate="{{ $unit->license_plate }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500">Belum ada unit kendaraan terdaftar untuk model ini.</p>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi untuk mengganti gambar utama di galeri
        function changeMainImage(src) {
            document.getElementById("mainImage").src = src;
        }

        // Handle semua form hapus Model Kendaraan (SweetAlert2)
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                confirmAndDelete(form, 'Yakin ingin menghapus?',
                    'Data model kendaraan ini dan SEMUA UNIT terkait akan dihapus secara permanen!');
            });
        });

        // Handle semua form hapus Unit Kendaraan (SweetAlert2)
        document.querySelectorAll('.delete-unit-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const licensePlate = form.closest('.flex').querySelector('p.text-lg').textContent;
                confirmAndDelete(form, 'Yakin ingin menghapus unit ini?',
                    `Unit kendaraan dengan plat nomor <strong>${licensePlate}</strong> akan dihapus secara permanen!`
                );
            });
        });

        // --- Logika Modal Edit Unit Kendaraan ---
        document.querySelectorAll('.edit-unit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const unitId = this.dataset.unitId;
                const licensePlate = this.dataset.licensePlate;
                const status = this.dataset.status;
                const vehicleId = {{ $vehicle->id }};
                const updateUrl = `/admin/vehicles/${vehicleId}/units/${unitId}`;

                Swal.fire({
                    title: `Edit Unit ${licensePlate}`,
                    html: `
                    <form id="editUnitForm" class="space-y-4 text-left px-4">
                        <div class="mb-4">
                            <label for="edit_unit_license_plate" class="block text-sm font-medium text-gray-700 mb-2">Nomor Plat</label>
                            <input type="text" id="edit_unit_license_plate" name="license_plate" value="${licensePlate}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" required>
                            <p id="edit_license_plate_error" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        <div class="mb-4">
                            <label for="edit_unit_status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="edit_unit_status" name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" required>
                                <option value="tersedia" ${status === 'tersedia' ? 'selected' : ''}>Tersedia</option>
                                <option value="disewa" ${status === 'disewa' ? 'selected' : ''}>Disewa</option>
                                <option value="maintenance" ${status === 'maintenance' ? 'selected' : ''}>Maintenance</option>
                                <option value="unavailable" ${status === 'unavailable' ? 'selected' : ''}>Tidak Tersedia</option>
                            </select>
                            <p id="edit_status_error" class="text-sm text-red-600 mt-1 hidden"></p>
                        </div>
                        @csrf
                        @method('PUT')
                    </form>
                `,
                    showCancelButton: true,
                    confirmButtonText: 'Simpan Perubahan',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm: true,
                    preConfirm: async () => {
                        const form = document.getElementById('editUnitForm');
                        const formData = new FormData(form);

                        try {
                            const response = await fetch(updateUrl, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'Accept': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            });

                            if (!response.ok) {
                                const errorData = await response.json();
                                if (response.status === 404) {
                                    throw new Error(
                                        'Unit tidak ditemukan. Muat ulang halaman.');
                                }
                                if (response.status === 422 && errorData.errors) {
                                    handleValidationErrors(errorData.errors);
                                    return false;
                                }
                                throw new Error(errorData.message ||
                                    'Terjadi kesalahan saat menyimpan.');
                            }
                            return response.json();
                        } catch (error) {
                            showError(
                                `Gagal: ${error.message}`);
                            return false;
                        }
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        showSuccess(result.value.message ||
                            'Unit kendaraan berhasil diperbarui.');
                        setTimeout(() => location.reload(), 1500);
                    }
                });
            });
        });

        // Fungsi untuk menangani error validasi
        function handleValidationErrors(errors) {
            // Reset error messages
            document.getElementById('edit_license_plate_error').classList.add('hidden');
            document.getElementById('edit_status_error').classList.add('hidden');

            // Show new errors
            if (errors.license_plate) {
                const errorElement = document.getElementById('edit_license_plate_error');
                errorElement.textContent = errors.license_plate[0];
                errorElement.classList.remove('hidden');
            }
            if (errors.status) {
                const errorElement = document.getElementById('edit_status_error');
                errorElement.textContent = errors.status[0];
                errorElement.classList.remove('hidden');
            }
        }

        // Handle tombol hapus unit
        document.querySelectorAll('.delete-unit-btn').forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('form');
                const licensePlate = this.dataset.licensePlate;
                // Memanggil fungsi generik confirmAndDelete
                confirmAndDelete(form, 'Yakin ingin menghapus?',
                    `Unit dengan plat <strong>${licensePlate}</strong> akan dihapus permanen!`);
            });
        });
    </script>
@endpush

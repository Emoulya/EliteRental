{{-- resources/views/admin/vehicles/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Kendaraan Baru - Elite Rental Admin')
@section('page_title', 'Tambah Kendaraan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-navy">
                Tambah Kendaraan Baru
            </h3>
            <a href="{{ route('admin.vehicles') }}" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <form id="addVehicleForm" method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data"
            class="space-y-6" onsubmit="showCustomMessage('Menambah kendaraan...', 'info');">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Informasi Dasar</h4>

                    <x-forms.text-input label="Merk Kendaraan" id="brand" name="brand" required
                        placeholder="Contoh: Toyota" value="{{ old('brand') }}" />
                    @error('brand')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Model Kendaraan" id="model" name="model" required
                        placeholder="Contoh: Avanza" value="{{ old('model') }}" />
                    @error('model')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Kategori" id="category" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="mobil-keluarga" @selected(old('category') == 'mobil-keluarga')>Mobil Keluarga</option>
                        <option value="suv" @selected(old('category') == 'suv')>SUV</option>
                        <option value="sedan" @selected(old('category') == 'sedan')>Sedan</option>
                        <option value="hatchback" @selected(old('category') == 'hatchback')>Hatchback</option>
                        <option value="motor" @selected(old('category') == 'motor')>Motor</option>
                        <option value="pickup" @selected(old('category') == 'pickup')>Pick Up</option>
                    </x-forms.select-input>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tahun Produksi" id="year" name="year" type="number" required
                        min="1990" max="{{ date('Y') + 1 }}" placeholder="2023" value="{{ old('year') }}" />
                    @error('year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Warna" id="color" name="color" required placeholder="Contoh: Putih"
                        value="{{ old('color') }}" />
                    @error('color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Spesifikasi & Harga</h4>

                    <x-forms.text-input label="Kapasitas Penumpang" id="passenger_capacity" name="passenger_capacity"
                        type="number" min="1" placeholder="7" value="{{ old('passenger_capacity') }}" />
                    @error('passenger_capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Transmisi" id="transmission_type" name="transmission_type" required>
                        <option value="">Pilih Transmisi</option>
                        <option value="manual" @selected(old('transmission_type') == 'manual')>Manual</option>
                        <option value="automatic" @selected(old('transmission_type') == 'automatic')>Automatic</option>
                    </x-forms.select-input>
                    @error('transmission_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Jenis Bahan Bakar" id="fuel_type" name="fuel_type" required>
                        <option value="">Pilih Bahan Bakar</option>
                        <option value="bensin" @selected(old('fuel_type') == 'bensin')>Bensin</option>
                        <option value="diesel" @selected(old('fuel_type') == 'diesel')>Diesel</option>
                        <option value="listrik" @selected(old('fuel_type') == 'listrik')>Listrik</option>
                    </x-forms.select-input>
                    @error('fuel_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Fitur Utama" id="features" name="features">
                        <option value="">Pilih Fitur Utama</option>
                        <option value="ac" @selected(old('features') == 'ac')>AC</option>
                        <option value="air_vent" @selected(old('features') == 'air_vent')>Air Vent</option>
                        <option value="helmet" @selected(old('features') == 'helmet')>Helm</option>
                        <option value="open_tub" @selected(old('features') == 'open_tub')>Open Tub (untuk Pickup)</option>
                    </x-forms.select-input>
                    @error('features')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Hari (Rp)" id="daily_price" name="daily_price"
                        type="number" required min="0" placeholder="300000" value="{{ old('daily_price') }}" />
                    @error('daily_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Normal per Hari (Rp) (untuk diskon, opsional)"
                        id="original_daily_price" name="original_daily_price" type="number" min="0"
                        placeholder="350000" value="{{ old('original_daily_price') }}" />
                    @error('original_daily_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Minggu (Rp)" id="weekly_price" name="weekly_price"
                        type="number" min="0" placeholder="1800000" value="{{ old('weekly_price') }}" />
                    @error('weekly_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Bulan (Rp)" id="monthly_price" name="monthly_price"
                        type="number" min="0" placeholder="6500000" value="{{ old('monthly_price') }}" />
                    @error('monthly_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tipe Mesin" id="engine_type" name="engine_type"
                        placeholder="Contoh: 1.3L DOHC VVT-i" value="{{ old('engine_type') }}" />
                    @error('engine_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tenaga Maksimal" id="max_power" name="max_power"
                        placeholder="Contoh: 96 PS / 6,000 rpm" value="{{ old('max_power') }}" />
                    @error('max_power')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Torsi Maksimal" id="max_torque" name="max_torque"
                        placeholder="Contoh: 121 Nm / 4,400 rpm" value="{{ old('max_torque') }}" />
                    @error('max_torque')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Transmisi" id="transmission" name="transmission"
                        placeholder="Manual 5-Speed" value="{{ old('transmission') }}" />
                    @error('transmission')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Konsumsi BBM (km/liter)" id="fuel_efficiency" name="fuel_efficiency"
                        placeholder="Contoh: 13-15 km/liter" value="{{ old('fuel_efficiency') }}" />
                    @error('fuel_efficiency')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Dimensi & Kapasitas</h4>
                    <x-forms.text-input label="Panjang (mm)" id="length" name="length" type="number"
                        min="0" placeholder="4190" value="{{ old('length') }}" />
                    @error('length')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Lebar (mm)" id="width" name="width" type="number" min="0"
                        placeholder="1660" value="{{ old('width') }}" />
                    @error('width')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tinggi (mm)" id="height" name="height" type="number" min="0"
                        placeholder="1695" value="{{ old('height') }}" />
                    @error('height')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Wheelbase (mm)" id="wheelbase" name="wheelbase" type="number"
                        min="0" placeholder="2655" value="{{ old('wheelbase') }}" />
                    @error('wheelbase')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Kapasitas Tangki (Liter)" id="tank_capacity" name="tank_capacity"
                        type="number" min="0" placeholder="45" value="{{ old('tank_capacity') }}" />
                    @error('tank_capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Fitur & Fasilitas Tambahan</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $additionalFeatures = old('additional_features', []);
                    @endphp
                    <x-forms.checkbox-field name="additional_features[]" value="ac_double_blower"
                        label="AC Double Blower" :checked="in_array('ac_double_blower', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="audio_system"
                        label="Audio System dengan USB" :checked="in_array('audio_system', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="power_steering" label="Power Steering"
                        :checked="in_array('power_steering', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="central_lock" label="Central Lock"
                        :checked="in_array('central_lock', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="electric_mirror" label="Electric Mirror"
                        :checked="in_array('electric_mirror', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="foldable_third_row_seats"
                        label="Kursi Baris Ketiga Lipat" :checked="in_array('foldable_third_row_seats', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="dual_srs_airbag" label="Dual SRS Airbag"
                        :checked="in_array('dual_srs_airbag', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="abs_ebd" label="ABS + EBD"
                        :checked="in_array('abs_ebd', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="3_point_seatbelts"
                        label="Sabuk Pengaman 3-Titik" :checked="in_array('3_point_seatbelts', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="immobilizer" label="Immobilizer"
                        :checked="in_array('immobilizer', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="child_safety_lock"
                        label="Child Safety Lock" :checked="in_array('child_safety_lock', $additionalFeatures)" />
                    <x-forms.checkbox-field name="additional_features[]" value="hazard_lights" label="Lampu Hazard"
                        :checked="in_array('hazard_lights', $additionalFeatures)" />
                </div>
                @error('additional_features')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Fasilitas Tambahan Elite Rental</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @php
                        $eliteFeatures = old('elite_features', []);
                    @endphp
                    <x-forms.checkbox-field name="elite_features[]" value="full_fuel"
                        label="BBM Penuh (saat serah terima)" :checked="in_array('full_fuel', $eliteFeatures)" />
                    <x-forms.checkbox-field name="elite_features[]" value="complete_toolkit" label="Toolkit Lengkap"
                        :checked="in_array('complete_toolkit', $eliteFeatures)" />
                    <x-forms.checkbox-field name="elite_features[]" value="24_7_support" label="Support 24/7"
                        :checked="in_array('24_7_support', $eliteFeatures)" />
                </div>
                @error('elite_features')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <x-forms.textarea-input label="Deskripsi Lengkap" id="long_description" name="long_description"
                rows="4"
                placeholder="Deskripsi detail tentang kendaraan, keunggulan, dll.">{{ old('long_description') }}</x-forms.textarea-input>
            @error('long_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Syarat & Ketentuan Sewa</h4>
                <div class="space-y-4">
                    <x-forms.textarea-input label="Persyaratan Penyewa" id="rental_requirements"
                        name="rental_requirements" rows="3"
                        placeholder="Contoh: - Usia minimal 21 tahun&#10;- Memiliki SIM A yang masih berlaku">{{ old('rental_requirements') }}</x-forms.textarea-input>
                    @error('rental_requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Ketentuan Sewa Kendaraan" id="rental_terms" name="rental_terms"
                        rows="3"
                        placeholder="Contoh: - Sewa minimal 24 jam&#10;- Overtime dikenakan biaya Rp 25.000/jam">{{ old('rental_terms') }}</x-forms.textarea-input>
                    @error('rental_terms')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Informasi Deposit & Pembayaran" id="deposit_payment_info"
                        name="deposit_payment_info" rows="3"
                        placeholder="Contoh: - Deposit Rp 500.000&#10;- Pembayaran dapat dilakukan tunai atau transfer">{{ old('deposit_payment_info') }}</x-forms.textarea-input>
                    @error('deposit_payment_info')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Larangan Selama Sewa" id="prohibitions" name="prohibitions"
                        rows="3"
                        placeholder="Contoh: - Dilarang merokok di dalam kendaraan&#10;- Dilarang membawa hewan peliharaan">{{ old('prohibitions') }}</x-forms.textarea-input>
                    @error('prohibitions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Upload Gambar</h4>
                <div>
                    <label for="mainImageUpload" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                        Utama Kendaraan</label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300 mb-4">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 mb-2">Drag & drop gambar utama atau klik untuk browse</p>
                        <input type="file" name="main_image" accept="image/*" class="hidden" id="mainImageUpload" />
                        <button type="button" onclick="document.getElementById('mainImageUpload').click()"
                            class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                            Pilih Gambar Utama
                        </button>
                    </div>
                    @error('main_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="galleryImageUpload" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                        Galeri (Bisa Pilih Banyak)</label>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                        <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 mb-2">Drag & drop gambar galeri atau klik untuk browse</p>
                        <input type="file" name="gallery_images[]" multiple accept="image/*" class="hidden"
                            id="galleryImageUpload" />
                        <button type="button" onclick="document.getElementById('galleryImageUpload').click()"
                            class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                            Pilih Gambar Galeri
                        </button>
                    </div>
                    @error('gallery_images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    {{-- Jika ada error per item galeri --}}
                    @foreach ($errors->get('gallery_images.*') as $message)
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-navy font-medium hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kendaraan
                </button>
                <a href="{{ route('admin.vehicles') }}"
                    class="mt-3 inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    {{-- Script untuk menampilkan pesan error validasi setelah redirect --}}
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Periksa apakah ada error validasi
                @if ($errors->any())
                    showCustomMessage('Terdapat kesalahan validasi, mohon periksa kembali input Anda.', 'error');
                @endif
            });
        </script>
    @endpush
@endsection

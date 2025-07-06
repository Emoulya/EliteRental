{{-- resources/views/admin/vehicles/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Kendaraan - Elite Rental Admin')
@section('page_title', 'Edit Kendaraan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-navy">
                Edit Kendaraan: {{ $vehicle->brand }} {{ $vehicle->model }}
            </h3>
            <a href="{{ route('admin.vehicles') }}" class="text-gray-400 hover:text-gray-600 transition duration-300">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>

        <form id="editVehicleForm" method="POST" action="{{ route('admin.vehicles.update', $vehicle->id) }}"
            enctype="multipart/form-data" class="space-y-6"
            onsubmit="showLoading('Memperbarui kendaraan...');">
            @csrf
            @method('PUT')
            <input type="hidden" name="_referrer" value="{{ request()->query('_referrer') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Informasi Dasar</h4>

                    <x-forms.text-input label="Merk Kendaraan" id="editBrand" name="brand" required
                        placeholder="Contoh: Toyota" value="{{ old('brand', $vehicle->brand) }}" />
                    @error('brand')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Model Kendaraan" id="editModel" name="model" required
                        placeholder="Contoh: Avanza" value="{{ old('model', $vehicle->model) }}" />
                    @error('model')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Kategori" id="editCategory" name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="mobil-keluarga" @selected(old('category', $vehicle->category) == 'mobil-keluarga')>Mobil Keluarga</option>
                        <option value="mobil-mewah" @selected(old('category', $vehicle->category) == 'mobil-mewah')>Mobil Mewah</option>
                        <option value="motor" @selected(old('category', $vehicle->category) == 'motor')>Motor</option>
                        <option value="pickup" @selected(old('category', $vehicle->category) == 'pickup')>Pick Up</option>
                    </x-forms.select-input>
                    @error('category')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tahun Produksi" id="editYear" name="year" type="number" required
                        min="1990" max="{{ date('Y') + 1 }}" placeholder="2023"
                        value="{{ old('year', $vehicle->year) }}" />
                    @error('year')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Warna" id="editColor" name="color" required placeholder="Contoh: Putih"
                        value="{{ old('color', $vehicle->color) }}" />
                    @error('color')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Spesifikasi & Harga</h4>

                    <x-forms.text-input label="Kapasitas Penumpang" id="editPassengerCapacity" name="passenger_capacity"
                        type="number" min="1" placeholder="7"
                        value="{{ old('passenger_capacity', $vehicle->passenger_capacity) }}" />
                    @error('passenger_capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Transmisi" id="editTransmissionType" name="transmission_type">
                        <option value="">Pilih Transmisi</option>
                        <option value="manual" @selected(old('transmission_type', $vehicle->transmission_type) == 'manual')>Manual</option>
                        <option value="automatic" @selected(old('transmission_type', $vehicle->transmission_type) == 'automatic')>Automatic</option>
                    </x-forms.select-input>
                    @error('transmission_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Jenis Bahan Bakar" id="editFuelType" name="fuel_type">
                        <option value="">Pilih Bahan Bakar</option>
                        <option value="bensin" @selected(old('fuel_type', $vehicle->fuel_type) == 'bensin')>Bensin</option>
                        <option value="diesel" @selected(old('fuel_type', $vehicle->fuel_type) == 'diesel')>Diesel</option>
                        <option value="listrik" @selected(old('fuel_type', $vehicle->fuel_type) == 'listrik')>Listrik</option>
                    </x-forms.select-input>
                    @error('fuel_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.select-input label="Fitur Utama" id="editFeatures" name="features">
                        <option value="">Pilih Fitur Utama</option>
                        <option value="ac" @selected(old('features', $vehicle->features) == 'ac')>AC</option>
                        <option value="air_vent" @selected(old('features', $vehicle->features) == 'air_vent')>Air Vent</option>
                        <option value="helmet" @selected(old('features', $vehicle->features) == 'helmet')>Helm</option>
                        <option value="open_tub" @selected(old('features', $vehicle->features) == 'open_tub')>Open Tub (untuk Pickup)</option>
                    </x-forms.select-input>
                    @error('features')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Hari (Rp)" id="editDailyPrice" name="daily_price"
                        type="number" required min="0" placeholder="300000"
                        value="{{ old('daily_price', $vehicle->daily_price) }}" />
                    @error('daily_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Normal per Hari (Rp) (untuk diskon, opsional)"
                        id="editOriginalDailyPrice" name="original_daily_price" type="number" min="0"
                        placeholder="350000" value="{{ old('original_daily_price', $vehicle->original_daily_price) }}" />
                    @error('original_daily_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Minggu (Rp)" id="editWeeklyPrice" name="weekly_price"
                        type="number" min="0" placeholder="1800000"
                        value="{{ old('weekly_price', $vehicle->weekly_price) }}" />
                    @error('weekly_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Harga Sewa per Bulan (Rp)" id="editMonthlyPrice" name="monthly_price"
                        type="number" min="0" placeholder="6500000"
                        value="{{ old('monthly_price', $vehicle->monthly_price) }}" />
                    @error('monthly_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tipe Mesin" id="editEngineType" name="engine_type"
                        placeholder="Contoh: 1.3L DOHC VVT-i" value="{{ old('engine_type', $vehicle->engine_type) }}" />
                    @error('engine_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tenaga Maksimal" id="editMaxPower" name="max_power"
                        placeholder="Contoh: 96 PS / 6,000 rpm" value="{{ old('max_power', $vehicle->max_power) }}" />
                    @error('max_power')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Torsi Maksimal" id="editMaxTorque" name="max_torque"
                        placeholder="Contoh: 121 Nm / 4,400 rpm" value="{{ old('max_torque', $vehicle->max_torque) }}" />
                    @error('max_torque')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Transmisi" id="editTransmission" name="transmission"
                        placeholder="Manual 5-Speed" value="{{ old('transmission', $vehicle->transmission) }}" />
                    @error('transmission')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Konsumsi BBM (km/liter)" id="editFuelEfficiency" name="fuel_efficiency"
                        placeholder="Contoh: 13-15 km/liter"
                        value="{{ old('fuel_efficiency', $vehicle->fuel_efficiency) }}" />
                    @error('fuel_efficiency')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <h4 class="text-lg font-semibold text-navy border-b pb-2">Dimensi & Kapasitas</h4>
                    <x-forms.text-input label="Panjang (mm)" id="editLength" name="length" type="number"
                        min="0" placeholder="4190" value="{{ old('length', $vehicle->length) }}" />
                    @error('length')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Lebar (mm)" id="editWidth" name="width" type="number" min="0"
                        placeholder="1660" value="{{ old('width', $vehicle->width) }}" />
                    @error('width')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Tinggi (mm)" id="editHeight" name="height" type="number"
                        min="0" placeholder="1695" value="{{ old('height', $vehicle->height) }}" />
                    @error('height')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Wheelbase (mm)" id="editWheelbase" name="wheelbase" type="number"
                        min="0" placeholder="2655" value="{{ old('wheelbase', $vehicle->wheelbase) }}" />
                    @error('wheelbase')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.text-input label="Kapasitas Tangki (Liter)" id="editTankCapacity" name="tank_capacity"
                        type="number" min="0" placeholder="45"
                        value="{{ old('tank_capacity', $vehicle->tank_capacity) }}" />
                    @error('tank_capacity')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Fitur & Fasilitas Tambahan</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $additionalFeatures = old('additional_features', $vehicle->additional_features ?? []);
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
                        $eliteFeatures = old('elite_features', $vehicle->elite_features ?? []);
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

            <x-forms.textarea-input label="Deskripsi Lengkap" id="editLongDescription" name="long_description"
                rows="4"
                placeholder="Deskripsi detail tentang kendaraan, keunggulan, dll.">{{ old('long_description', $vehicle->long_description) }}</x-forms.textarea-input>
            @error('long_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Syarat & Ketentuan Sewa</h4>
                <div class="space-y-4">
                    <x-forms.textarea-input label="Persyaratan Penyewa" id="editRentalRequirements"
                        name="rental_requirements" rows="3"
                        placeholder="Contoh: - Usia minimal 21 tahun&#10;- Memiliki SIM A yang masih berlaku">{{ old('rental_requirements', $vehicle->rental_requirements) }}</x-forms.textarea-input>
                    @error('rental_requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Ketentuan Sewa Kendaraan" id="editRentalTerms" name="rental_terms"
                        rows="3"
                        placeholder="Contoh: - Sewa minimal 24 jam&#10;- Overtime dikenakan biaya Rp 25.000/jam">{{ old('rental_terms', $vehicle->rental_terms) }}</x-forms.textarea-input>
                    @error('rental_terms')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Informasi Deposit & Pembayaran" id="editDepositPaymentInfo"
                        name="deposit_payment_info" rows="3"
                        placeholder="Contoh: - Deposit Rp 500.000&#10;- Pembayaran dapat dilakukan tunai atau transfer">{{ old('deposit_payment_info', $vehicle->deposit_payment_info) }}</x-forms.textarea-input>
                    @error('deposit_payment_info')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <x-forms.textarea-input label="Larangan Selama Sewa" id="editProhibitions" name="prohibitions"
                        rows="3"
                        placeholder="Contoh: - Dilarang merokok di dalam kendaraan&#10;- Dilarang membawa hewan peliharaan">{{ old('prohibitions', $vehicle->prohibitions) }}</x-forms.textarea-input>
                    @error('prohibitions')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Update Gambar</h4>
                <div class="mb-4">
                    <label for="editMainImageUpload" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                        Utama Kendaraan</label>
                    <div class="flex items-center space-x-4 mb-2">
                        @if ($vehicle->main_image)
                            <img id="editMainImagePreview" src="{{ asset('storage/' . $vehicle->main_image) }}"
                                alt="Gambar Utama" class="w-24 h-24 object-cover rounded" />
                            <span id="editCurrentMainImagePath" class="text-gray-600 text-sm">
                                {{ basename($vehicle->main_image) }}
                            </span>
                        @else
                            <img id="editMainImagePreview" src="" alt="Gambar Utama"
                                class="w-24 h-24 object-cover rounded hidden" />
                            <span id="editCurrentMainImagePath" class="text-gray-600 text-sm">Tidak ada gambar
                                utama</span>
                        @endif
                    </div>
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 mb-2">Drag & drop gambar utama baru atau klik untuk browse</p>
                        <input type="file" name="main_image" accept="image/*" class="hidden"
                            id="editMainImageUpload" />
                        <button type="button" onclick="document.getElementById('editMainImageUpload').click()"
                            class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                            Pilih Gambar Utama Baru
                        </button>
                        <label class="mt-2 block text-sm text-gray-500">Kosongkan jika tidak ingin
                            mengubah</label>
                        <div class="mt-2 flex items-center">
                            <input type="checkbox" id="clearMainImage" name="clear_main_image" value="1"
                                class="rounded border-gray-300 text-gold focus:ring-gold" />
                            <label for="clearMainImage" class="ml-2 text-sm text-gray-700">Hapus Gambar
                                Utama</label>
                        </div>
                    </div>
                    @error('main_image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="editGalleryImageUpload" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                        Galeri (Bisa Pilih Banyak)</label>
                    <div id="existingGalleryImagesContainer" class="flex flex-wrap gap-2 mb-4">
                        {{-- Existing gallery images will be loaded here by JavaScript or blade loop --}}
                        @forelse($vehicle->gallery_images as $imagePath)
                            <div class="relative inline-block m-1">
                                <img src="{{ asset('storage/' . $imagePath) }}" class="w-20 h-20 object-cover rounded" />
                                <input type="hidden" name="existing_gallery_images[]" value="{{ $imagePath }}" />
                                <button type="button"
                                    class="remove-gallery-image absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 text-xs"
                                    data-path="{{ $imagePath }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada gambar galeri.</p>
                        @endforelse
                    </div>
                    @error('gallery_images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <div
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                        <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-500 mb-2">Drag & drop gambar galeri baru atau klik untuk browse</p>
                        <input type="file" name="gallery_images[]" multiple accept="image/*" class="hidden"
                            id="editGalleryImageUpload" />
                        <button type="button" onclick="document.getElementById('editGalleryImageUpload').click()"
                            class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                            Pilih Gambar Galeri Baru
                        </button>
                    </div>
                    @foreach ($errors->get('gallery_images.*') as $message)
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-navy font-medium hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.vehicles') }}"
                    class="mt-3 inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            // Logika untuk menghapus gambar galeri yang sudah ada di halaman edit
            document.querySelectorAll('.remove-gallery-image').forEach(button => {
                button.addEventListener('click', function() {
                    this.closest('.relative').remove();
                });
            });

            // Logika untuk preview gambar utama baru
            document.getElementById('editMainImageUpload').addEventListener('change', function(event) {
                const preview = document.getElementById('editMainImagePreview');
                const currentPathText = document.getElementById('editCurrentMainImagePath');
                if (event.target.files && event.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        currentPathText.textContent = event.target.files[0].name;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            });

            // Logika untuk checkbox "Hapus Gambar Utama"
            document.getElementById('clearMainImage').addEventListener('change', function() {
                const preview = document.getElementById('editMainImagePreview');
                const currentPathText = document.getElementById('editCurrentMainImagePath');
                const mainImageUpload = document.getElementById('editMainImageUpload');

                if (this.checked) {
                    preview.classList.add('hidden');
                    preview.src = '';
                    currentPathText.textContent = 'Gambar utama akan dihapus';
                    mainImageUpload.value = '';
                } else {
                    // Jika tidak dicentang, kembalikan tampilan ke gambar lama atau default
                    @if ($vehicle->main_image)
                        preview.src = "{{ asset('storage/' . $vehicle->main_image) }}";
                        preview.classList.remove('hidden');
                        currentPathText.textContent = "{{ basename($vehicle->main_image) }}";
                    @else
                        preview.classList.add('hidden');
                        preview.src = '';
                        currentPathText.textContent = 'Tidak ada gambar utama';
                    @endif
                }
            });

            // Script untuk menampilkan pesan error validasi setelah redirect
            document.addEventListener('DOMContentLoaded', function() {
                // Periksa apakah ada error validasi
                @if ($errors->any())
                    showError('Terdapat kesalahan validasi, mohon periksa kembali input Anda.');
                @endif
            });
        </script>
    @endpush
@endsection

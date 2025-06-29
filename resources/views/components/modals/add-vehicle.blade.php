{{-- resources\views\components\modals\add-vehicle.blade.php --}}
@props(['id' => 'addVehicleModal'])

<div id="{{ $id }}" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <!-- Modal Panel -->
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-navy">
                        Tambah Kendaraan Baru
                    </h3>
                    <button id="closeModal" type="button"
                        class="text-gray-400 hover:text-gray-600 transition duration-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="addVehicleForm" method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informasi Dasar Kendaraan -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Informasi Dasar</h4>

                            <x-forms.text-input label="Merk Kendaraan" id="brand" name="brand" required
                                placeholder="Contoh: Toyota" />
                            <x-forms.text-input label="Model Kendaraan" id="model" name="model" required
                                placeholder="Contoh: Avanza" />
                            <x-forms.select-input label="Kategori" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="mobil-keluarga">Mobil Keluarga</option>
                                <option value="suv">SUV</option>
                                <option value="sedan">Sedan</option>
                                <option value="hatchback">Hatchback</option>
                                <option value="motor">Motor</option>
                                <option value="pickup">Pick Up</option>
                            </x-forms.select-input>
                            <x-forms.text-input label="Nomor Polisi" id="license_plate" name="license_plate" required
                                placeholder="Contoh: B 1234 ABC" />
                            <x-forms.text-input label="Tahun Produksi" id="year" name="year" type="number"
                                required min="1990" max="2025" placeholder="2023" />
                            <x-forms.text-input label="Warna" id="color" name="color" required
                                placeholder="Contoh: Putih" />
                            <x-forms.select-input label="Status Ketersediaan" id="status" name="status" required>
                                <option value="available">Tersedia</option>
                                <option value="rented">Disewa</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="unavailable">Tidak Tersedia</option>
                            </x-forms.select-input>
                        </div>

                        <!-- Spesifikasi & Harga -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Spesifikasi & Harga</h4>

                            <x-forms.text-input label="Kapasitas Penumpang" id="passenger_capacity"
                                name="passenger_capacity" type="number" min="1" placeholder="7" />
                            <x-forms.select-input label="Transmisi" id="transmission_type" name="transmission_type"
                                required>
                                <option value="">Pilih Transmisi</option>
                                <option value="manual">Manual</option>
                                <option value="automatic">Automatic</option>
                            </x-forms.select-input>
                            <x-forms.select-input label="Jenis Bahan Bakar" id="fuel_type" name="fuel_type" required>
                                <option value="">Pilih Bahan Bakar</option>
                                <option value="bensin">Bensin</option>
                                <option value="diesel">Diesel</option>
                                <option value="listrik">Listrik</option>
                            </x-forms.select-input>
                            <x-forms.select-input label="Pendingin Udara" id="air_conditioning" name="air_conditioning"
                                required>
                                <option value="">Pilih Pendingin Udara</option>
                                <option value="ac">AC</option>
                                <option value="air_vent">Air Vent</option>
                            </x-forms.select-input>
                            <x-forms.text-input label="Harga Sewa per Hari (Rp)" id="daily_price" name="daily_price"
                                type="number" required min="0" placeholder="300000" />
                            <x-forms.text-input label="Harga Normal per Hari (Rp) (untuk diskon, opsional)"
                                id="original_daily_price" name="original_daily_price" type="number" min="0"
                                placeholder="350000" />
                            <x-forms.text-input label="Harga Sewa per Minggu (Rp)" id="weekly_price" name="weekly_price"
                                type="number" min="0" placeholder="1800000" />
                            <x-forms.text-input label="Harga Sewa per Bulan (Rp)" id="monthly_price"
                                name="monthly_price" type="number" min="0" placeholder="6500000" />

                            <x-forms.text-input label="Tipe Mesin" id="engine_type" name="engine_type"
                                placeholder="Contoh: 1.3L DOHC VVT-i" />
                            <x-forms.text-input label="Tenaga Maksimal" id="max_power" name="max_power"
                                placeholder="Contoh: 96 PS / 6,000 rpm" />
                            <x-forms.text-input label="Torsi Maksimal" id="max_torque" name="max_torque"
                                placeholder="Contoh: 121 Nm / 4,400 rpm" />
                            <x-forms.text-input label="Transmisi" id="transmission" name="transmission"
                                placeholder="Manual 5-Speed" />
                            <x-forms.text-input label="Konsumsi BBM (km/liter)" id="fuel_efficiency"
                                name="fuel_efficiency" placeholder="Contoh: 13-15 km/liter" />

                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Dimensi & Kapasitas</h4>
                            <x-forms.text-input label="Panjang (mm)" id="length" name="length" type="number"
                                min="0" placeholder="4190" />
                            <x-forms.text-input label="Lebar (mm)" id="width" name="width" type="number"
                                min="0" placeholder="1660" />
                            <x-forms.text-input label="Tinggi (mm)" id="height" name="height" type="number"
                                min="0" placeholder="1695" />
                            <x-forms.text-input label="Wheelbase (mm)" id="wheelbase" name="wheelbase"
                                type="number" min="0" placeholder="2655" />
                            <x-forms.text-input label="Kapasitas Tangki (Liter)" id="tank_capacity"
                                name="tank_capacity" type="number" min="0" placeholder="45" />
                        </div>
                    </div>

                    <!-- Fitur & Fasilitas Kendaraan -->
                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Fitur & Fasilitas</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <x-forms.checkbox-field name="features[]" value="ac_double_blower"
                                label="AC Double Blower" />
                            <x-forms.checkbox-field name="features[]" value="audio_system"
                                label="Audio System dengan USB" />
                            <x-forms.checkbox-field name="features[]" value="power_steering"
                                label="Power Steering" />
                            <x-forms.checkbox-field name="features[]" value="central_lock" label="Central Lock" />
                            <x-forms.checkbox-field name="features[]" value="electric_mirror"
                                label="Electric Mirror" />
                            <x-forms.checkbox-field name="features[]" value="foldable_third_row_seats"
                                label="Kursi Baris Ketiga Lipat" />
                            <x-forms.checkbox-field name="features[]" value="dual_srs_airbag"
                                label="Dual SRS Airbag" />
                            <x-forms.checkbox-field name="features[]" value="abs_ebd" label="ABS + EBD" />
                            <x-forms.checkbox-field name="features[]" value="3_point_seatbelts"
                                label="Sabuk Pengaman 3-Titik" />
                            <x-forms.checkbox-field name="features[]" value="immobilizer" label="Immobilizer" />
                            <x-forms.checkbox-field name="features[]" value="child_safety_lock"
                                label="Child Safety Lock" />
                            <x-forms.checkbox-field name="features[]" value="hazard_lights" label="Lampu Hazard" />
                        </div>
                    </div>

                    <!-- Fasilitas Tambahan Elite Rental -->
                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Fasilitas Tambahan Elite Rental
                        </h4>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <x-forms.checkbox-field name="elite_features[]" value="full_fuel"
                                label="BBM Penuh (saat serah terima)" />
                            <x-forms.checkbox-field name="elite_features[]" value="complete_toolkit"
                                label="Toolkit Lengkap" />
                            <x-forms.checkbox-field name="elite_features[]" value="24_7_support"
                                label="Support 24/7" />
                        </div>
                    </div>

                    <!-- Deskripsi Kendaraan -->
                    <x-forms.textarea-input label="Deskripsi Lengkap" id="long_description" name="long_description"
                        rows="4" placeholder="Deskripsi detail tentang kendaraan, keunggulan, dll." />

                    <!-- Syarat & Ketentuan Sewa -->
                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Syarat & Ketentuan Sewa</h4>
                        <div class="space-y-4">
                            <x-forms.textarea-input label="Persyaratan Penyewa" id="rental_requirements"
                                name="rental_requirements" rows="3"
                                placeholder="Contoh: - Usia minimal 21 tahun&#10;- Memiliki SIM A yang masih berlaku" />
                            <x-forms.textarea-input label="Ketentuan Sewa Kendaraan" id="rental_terms"
                                name="rental_terms" rows="3"
                                placeholder="Contoh: - Sewa minimal 24 jam&#10;- Overtime dikenakan biaya Rp 25.000/jam" />
                            <x-forms.textarea-input label="Informasi Deposit & Pembayaran" id="deposit_payment_info"
                                name="deposit_payment_info" rows="3"
                                placeholder="Contoh: - Deposit Rp 500.000&#10;- Pembayaran dapat dilakukan tunai atau transfer" />
                            <x-forms.textarea-input label="Larangan Selama Sewa" id="prohibitions"
                                name="prohibitions" rows="3"
                                placeholder="Contoh: - Dilarang merokok di dalam kendaraan&#10;- Dilarang membawa hewan peliharaan" />
                        </div>
                    </div>

                    <!-- Upload Gambar -->
                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Upload Gambar</h4>
                        <div>
                            <label for="mainImageUpload" class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                Utama Kendaraan</label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300 mb-4">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500 mb-2">Drag & drop gambar utama atau klik untuk browse</p>
                                <input type="file" name="main_image" accept="image/*" class="hidden"
                                    id="mainImageUpload" />
                                <button type="button" onclick="document.getElementById('mainImageUpload').click()"
                                    class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                                    Pilih Gambar Utama
                                </button>
                            </div>
                        </div>
                        <div>
                            <label for="galleryImageUpload"
                                class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri (Bisa Pilih
                                Banyak)</label>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                                <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500 mb-2">Drag & drop gambar galeri atau klik untuk browse</p>
                                <input type="file" name="gallery_images[]" multiple accept="image/*"
                                    class="hidden" id="galleryImageUpload" />
                                <button type="button" onclick="document.getElementById('galleryImageUpload').click()"
                                    class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                                    Pilih Gambar Galeri
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-light-gray px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="addVehicleForm"
                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-navy font-medium hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Kendaraan
                </button>
                <button type="button" id="cancelModal"
                    class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<div id="editVehicleModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <div class="flex items-center justify-center min-h-screen px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-navy">
                        Edit Kendaraan
                    </h3>
                    <button type="button" id="closeEditModal"
                        class="text-gray-400 hover:text-gray-600 transition duration-300">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="editVehicleForm" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editVehicleId" name="vehicle_id">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Informasi Dasar</h4>

                            <x-forms.text-input label="Merk Kendaraan" id="editBrand" name="brand" required
                                placeholder="Contoh: Toyota" />
                            <x-forms.text-input label="Model Kendaraan" id="editModel" name="model" required
                                placeholder="Contoh: Avanza" />
                            <x-forms.select-input label="Kategori" id="editCategory" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="mobil-keluarga">Mobil Keluarga</option>
                                <option value="suv">SUV</option>
                                <option value="sedan">Sedan</option>
                                <option value="hatchback">Hatchback</option>
                                <option value="motor">Motor</option>
                                <option value="pickup">Pick Up</option>
                            </x-forms.select-input>
                            <x-forms.text-input label="Nomor Polisi" id="editLicensePlate" name="license_plate" required
                                placeholder="Contoh: B 1234 ABC" />
                            <x-forms.text-input label="Tahun Produksi" id="editYear" name="year" type="number"
                                required min="1990" max="2025" placeholder="2023" />
                            <x-forms.text-input label="Warna" id="editColor" name="color" required
                                placeholder="Contoh: Putih" />
                            <x-forms.select-input label="Status Ketersediaan" id="editStatus" name="status" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="disewa">Disewa</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="unavailable">Tidak Tersedia</option>
                            </x-forms.select-input>
                        </div>

                        <div class="space-y-4">
                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Spesifikasi & Harga</h4>

                            <x-forms.text-input label="Kapasitas Penumpang" id="editPassengerCapacity"
                                name="passenger_capacity" type="number" min="1" placeholder="7" />
                            <x-forms.select-input label="Transmisi" id="editTransmissionType" name="transmission_type">
                                <option value="">Pilih Transmisi</option>
                                <option value="manual">Manual</option>
                                <option value="automatic">Automatic</option>
                            </x-forms.select-input>
                            <x-forms.select-input label="Jenis Bahan Bakar" id="editFuelType" name="fuel_type">
                                <option value="">Pilih Bahan Bakar</option>
                                <option value="bensin">Bensin</option>
                                <option value="diesel">Diesel</option>
                                <option value="listrik">Listrik</option>
                            </x-forms.select-input>
                            <x-forms.select-input label="Pendingin Udara" id="editAirConditioning"
                                name="air_conditioning">
                                <option value="">Pilih Pendingin Udara</option>
                                <option value="ac">AC</option>
                                <option value="air_vent">Air Vent</option>
                            </x-forms.select-input>
                            <x-forms.text-input label="Harga Sewa per Hari (Rp)" id="editDailyPrice" name="daily_price"
                                type="number" required min="0" placeholder="300000" />
                            <x-forms.text-input label="Harga Normal per Hari (Rp) (untuk diskon, opsional)"
                                id="editOriginalDailyPrice" name="original_daily_price" type="number" min="0"
                                placeholder="350000" />
                            <x-forms.text-input label="Harga Sewa per Minggu (Rp)" id="editWeeklyPrice"
                                name="weekly_price" type="number" min="0" placeholder="1800000" />
                            <x-forms.text-input label="Harga Sewa per Bulan (Rp)" id="editMonthlyPrice"
                                name="monthly_price" type="number" min="0" placeholder="6500000" />

                            <x-forms.text-input label="Tipe Mesin" id="editEngineType" name="engine_type"
                                placeholder="Contoh: 1.3L DOHC VVT-i" />
                            <x-forms.text-input label="Tenaga Maksimal" id="editMaxPower" name="max_power"
                                placeholder="Contoh: 96 PS / 6,000 rpm" />
                            <x-forms.text-input label="Torsi Maksimal" id="editMaxTorque" name="max_torque"
                                placeholder="Contoh: 121 Nm / 4,400 rpm" />
                            <x-forms.text-input label="Transmisi" id="editTransmission" name="transmission"
                                placeholder="Manual 5-Speed" />
                            <x-forms.text-input label="Konsumsi BBM (km/liter)" id="editFuelEfficiency"
                                name="fuel_efficiency" placeholder="Contoh: 13-15 km/liter" />

                            <h4 class="text-lg font-semibold text-navy border-b pb-2">Dimensi & Kapasitas</h4>
                            <x-forms.text-input label="Panjang (mm)" id="editLength" name="length" type="number"
                                min="0" placeholder="4190" />
                            <x-forms.text-input label="Lebar (mm)" id="editWidth" name="width" type="number"
                                min="0" placeholder="1660" />
                            <x-forms.text-input label="Tinggi (mm)" id="editHeight" name="height" type="number"
                                min="0" placeholder="1695" />
                            <x-forms.text-input label="Wheelbase (mm)" id="editWheelbase" name="wheelbase"
                                type="number" min="0" placeholder="2655" />
                            <x-forms.text-input label="Kapasitas Tangki (Liter)" id="editTankCapacity"
                                name="tank_capacity" type="number" min="0" placeholder="45" />
                        </div>
                    </div>

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

                    <x-forms.textarea-input label="Deskripsi Lengkap" id="editLongDescription"
                        name="long_description" rows="4"
                        placeholder="Deskripsi detail tentang kendaraan, keunggulan, dll." />

                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Syarat & Ketentuan Sewa</h4>
                        <div class="space-y-4">
                            <x-forms.textarea-input label="Persyaratan Penyewa" id="editRentalRequirements"
                                name="rental_requirements" rows="3"
                                placeholder="Contoh: - Usia minimal 21 tahun&#10;- Memiliki SIM A yang masih berlaku" />
                            <x-forms.textarea-input label="Ketentuan Sewa Kendaraan" id="editRentalTerms"
                                name="rental_terms" rows="3"
                                placeholder="Contoh: - Sewa minimal 24 jam&#10;- Overtime dikenakan biaya Rp 25.000/jam" />
                            <x-forms.textarea-input label="Informasi Deposit & Pembayaran" id="editDepositPaymentInfo"
                                name="deposit_payment_info" rows="3"
                                placeholder="Contoh: - Deposit Rp 500.000&#10;- Pembayaran dapat dilakukan tunai atau transfer" />
                            <x-forms.textarea-input label="Larangan Selama Sewa" id="editProhibitions"
                                name="prohibitions" rows="3"
                                placeholder="Contoh: - Dilarang merokok di dalam kendaraan&#10;- Dilarang membawa hewan peliharaan" />
                        </div>
                    </div>

                    <div>
                        <h4 class="text-lg font-semibold text-navy border-b pb-2 mb-4">Update Gambar</h4>
                        <div class="mb-4">
                            <label for="editMainImageUpload"
                                class="block text-sm font-medium text-gray-700 mb-2">Gambar
                                Utama Kendaraan</label>
                            <div class="flex items-center space-x-4 mb-2">
                                <img id="editMainImagePreview" src="" alt="Gambar Utama"
                                    class="w-24 h-24 object-cover rounded hidden" />
                                <span id="editCurrentMainImagePath" class="text-gray-600 text-sm"></span>
                            </div>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500 mb-2">Drag & drop gambar utama baru atau klik untuk browse</p>
                                <input type="file" name="main_image" accept="image/*" class="hidden"
                                    id="editMainImageUpload" />
                                <button type="button"
                                    onclick="document.getElementById('editMainImageUpload').click()"
                                    class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                                    Pilih Gambar Utama Baru
                                </button>
                                <label class="mt-2 block text-sm text-gray-500">Kosongkan jika tidak ingin
                                    mengubah</label>
                                <div class="mt-2 flex items-center">
                                    <input type="checkbox" id="clearMainImage" name="clear_main_image"
                                        value="1" class="rounded border-gray-300 text-gold focus:ring-gold" />
                                    <label for="clearMainImage" class="ml-2 text-sm text-gray-700">Hapus Gambar
                                        Utama</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="editGalleryImageUpload"
                                class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri (Bisa Pilih
                                Banyak)</label>
                            <div id="existingGalleryImagesContainer" class="flex flex-wrap gap-2 mb-4">
                                {{-- Existing gallery images will be loaded here by JavaScript --}}
                            </div>
                            <div
                                class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gold transition duration-300">
                                <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-500 mb-2">Drag & drop gambar galeri baru atau klik untuk browse</p>
                                <input type="file" name="gallery_images[]" multiple accept="image/*"
                                    class="hidden" id="editGalleryImageUpload" />
                                <button type="button"
                                    onclick="document.getElementById('editGalleryImageUpload').click()"
                                    class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded transition duration-300">
                                    Pilih Gambar Galeri Baru
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-light-gray px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="editVehicleForm"
                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 bg-gold text-navy font-medium hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Perubahan
                </button>
                <button type="button" id="cancelEditModal"
                    class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-gray-700 font-medium hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition duration-300">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

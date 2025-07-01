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
                    <button
                        class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300 edit-btn"
                        data-vehicle='@json($vehicle)' {{-- Memuat data vehicle untuk modal edit --}}>
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </button>
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
                            class="w-full h-64 rounded-lg object-cover" />
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
                                <span class="text-gray-600">Pendingin Udara:</span>
                                <span
                                    class="font-medium text-navy">{{ strtoupper(str_replace('_', ' ', $vehicle->air_conditioning ?? '-')) }}</span>
                            </div>
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
                        Fitur & Fasilitas
                    </h4>
                </div>
                <div class="p-6">
                    @if ($vehicle->features && count($vehicle->features) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($vehicle->features as $feature)
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span class="text-gray-700">{{ ucwords(str_replace('_', ' ', $feature)) }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada fitur yang terdaftar.</p>
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
                                    <i class="fas fa-check-circle text-gold mr-2"></i>
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

    {{-- Sisipkan modal edit kendaraan di sini agar bisa digunakan --}}
    <x-modals.edit-vehicle />

@endsection

@push('scripts')
    {{-- JavaScript spesifik halaman detail kendaraan --}}
    <script>
        // Fungsi untuk mengganti gambar utama di galeri
        function changeMainImage(src) {
            document.getElementById("mainImage").src = src;
        }

        // Logic untuk membuka modal edit kendaraan (disalin dari vehicles.blade.php)
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", () => {
                const vehicle = JSON.parse(button.getAttribute("data-vehicle"));
                const editVehicleModal = document.getElementById("editVehicleModal");
                const form = document.getElementById("editVehicleForm");

                // Populate all fields (pastikan IDs ini ada di edit-vehicle.blade.php)
                document.getElementById("editBrand").value = vehicle.brand;
                document.getElementById("editModel").value = vehicle.model;
                document.getElementById("editLicensePlate").value = vehicle.license_plate;
                document.getElementById("editYear").value = vehicle.year;
                document.getElementById("editColor").value = vehicle.color;
                document.getElementById("editStatus").value = vehicle.status;
                document.getElementById("editPassengerCapacity").value = vehicle.passenger_capacity;
                document.getElementById("editTransmissionType").value = vehicle.transmission_type;
                document.getElementById("editFuelType").value = vehicle.fuel_type;
                document.getElementById("editAirConditioning").value = vehicle.air_conditioning;
                document.getElementById("editDailyPrice").value = vehicle.daily_price;
                document.getElementById("editOriginalDailyPrice").value = vehicle.original_daily_price;
                document.getElementById("editWeeklyPrice").value = vehicle.weekly_price;
                document.getElementById("editMonthlyPrice").value = vehicle.monthly_price;
                document.getElementById("editEngineType").value = vehicle.engine_type;
                document.getElementById("editMaxPower").value = vehicle.max_power;
                document.getElementById("editMaxTorque").value = vehicle.max_torque;
                document.getElementById("editTransmission").value = vehicle.transmission;
                document.getElementById("editFuelEfficiency").value = vehicle.fuel_efficiency;
                document.getElementById("editLength").value = vehicle.length;
                document.getElementById("editWidth").value = vehicle.width;
                document.getElementById("editHeight").value = vehicle.height;
                document.getElementById("editWheelbase").value = vehicle.wheelbase;
                document.getElementById("editTankCapacity").value = vehicle.tank_capacity;
                document.getElementById("editLongDescription").value = vehicle.long_description;
                document.getElementById("editRentalRequirements").value = vehicle.rental_requirements;
                document.getElementById("editRentalTerms").value = vehicle.rental_terms;
                document.getElementById("editDepositPaymentInfo").value = vehicle.deposit_payment_info;
                document.getElementById("editProhibitions").value = vehicle.prohibitions;


                // Populate features checkboxes
                const features = vehicle.features || [];
                document.querySelectorAll('#editVehicleForm input[name="features[]"]').forEach(checkbox => {
                    checkbox.checked = features.includes(checkbox.value);
                });

                // Populate elite_features checkboxes
                const eliteFeatures = vehicle.elite_features || [];
                document.querySelectorAll('#editVehicleForm input[name="elite_features[]"]').forEach(
                    checkbox => {
                        checkbox.checked = eliteFeatures.includes(checkbox.value);
                    });

                // Set main image preview
                const editMainImagePreview = document.getElementById('editMainImagePreview');
                const editCurrentMainImagePath = document.getElementById('editCurrentMainImagePath');
                if (vehicle.main_image) {
                    editMainImagePreview.src = `/storage/${vehicle.main_image}`;
                    editMainImagePreview.classList.remove('hidden');
                    editCurrentMainImagePath.textContent = vehicle.main_image.split('/').pop();
                    document.getElementById('clearMainImage').checked =
                    false; // Pastikan checkbox hapus tidak dicentang
                } else {
                    editMainImagePreview.classList.add('hidden');
                    editMainImagePreview.src = '';
                    editCurrentMainImagePath.textContent = 'Tidak ada gambar utama';
                }

                // Populate gallery images preview
                const existingGalleryImagesContainer = document.getElementById(
                    'existingGalleryImagesContainer');
                existingGalleryImagesContainer.innerHTML = ''; // Clear previous images
                if (vehicle.gallery_images && vehicle.gallery_images.length > 0) {
                    vehicle.gallery_images.forEach(imagePath => { // Pastikan ini adalah array
                        const div = document.createElement('div');
                        div.className = 'relative inline-block m-1';
                        div.innerHTML = `
                            <img src="/storage/${imagePath}" class="w-20 h-20 object-cover rounded" />
                            <input type="hidden" name="existing_gallery_images[]" value="${imagePath}" />
                            <button type="button" class="remove-gallery-image absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 text-xs" data-path="${imagePath}">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                        existingGalleryImagesContainer.appendChild(div);
                    });
                } else {
                    existingGalleryImagesContainer.innerHTML =
                        '<p class="text-gray-500">Tidak ada gambar galeri.</p>';
                }

                // Add event listener for removing existing gallery images
                document.querySelectorAll('.remove-gallery-image').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('.relative').remove();
                    });
                });

                form.action = `/admin/vehicles/${vehicle.id}`;
                document.getElementById("editVehicleId").value = vehicle
                .id; // Pastikan ID kendaraan di hidden input

                editVehicleModal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            });
        });

        // Event listener untuk tombol close atau cancel pada modal edit
        document.querySelectorAll("#cancelEditModal, #closeEditModal").forEach(btn => {
            btn.addEventListener("click", () => {
                document.getElementById("editVehicleModal").classList.add("hidden");
                document.body.style.overflow = "auto";
                // Anda mungkin ingin menambahkan clearErrors() di sini juga
            });
        });

        // Handle form submission for Update Vehicle (AJAX)
        const editVehicleForm = document.getElementById("editVehicleForm");
        if (editVehicleForm) {
            editVehicleForm.addEventListener("submit", async function(e) {
                e.preventDefault();

                showCustomMessage("Memperbarui kendaraan...", "info");
                // clearErrors(); // Bersihkan error sebelumnya

                const formData = new FormData(this);
                formData.append('_method', 'PUT'); // Penting untuk metode PUT

                try {
                    const response = await fetch(this.action, {
                        method: 'POST', // Method harus POST untuk FormData dengan _method PUT
                        body: formData,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        }
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showCustomMessage(result.message, "success");
                        document.getElementById("editVehicleModal").classList.add("hidden");
                        document.body.style.overflow = "auto";
                        location.reload(); // Reload halaman untuk melihat data yang diperbarui
                    } else if (response.status === 422) {
                        showCustomMessage("Terjadi kesalahan validasi. Mohon periksa kembali input Anda.",
                            "error");
                        // Asumsi Anda punya displayErrors() dan clearErrors() di scope global
                        // displayErrors(result.errors);
                        console.error('Validation Errors:', result.errors);
                    } else {
                        showCustomMessage(result.message || "Terjadi kesalahan server.", "error");
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showCustomMessage("Terjadi kesalahan jaringan atau sistem.", "error");
                }
            });
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
                        showCustomMessage('Menghapus kendaraan...', 'info');
                        form.submit(); // Lanjutkan pengiriman form jika dikonfirmasi
                    }
                });
            });
        });
    </script>
@endpush

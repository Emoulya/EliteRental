{{-- resources/views/admin/vehicles.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kendaraan - Elite Rental Admin')
@section('page_title', 'Manajemen Kendaraan')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <x-statistics.stat-card title="Total Kendaraan" :value="$total" icon="car" iconBgColor="bg-blue-100"
            iconTextColor="text-blue-600" />
        <x-statistics.stat-card title="Tersedia" :value="$tersedia" icon="check-circle" iconBgColor="bg-green-100"
            iconTextColor="text-green-600" />
        <x-statistics.stat-card title="Disewa" :value="$disewa" icon="times-circle" iconBgColor="bg-red-100"
            iconTextColor="text-red-600" />
        <x-statistics.stat-card title="Maintenance" :value="$maintenance" icon="tools" iconBgColor="bg-yellow-100"
            iconTextColor="text-yellow-600" />
        <x-statistics.stat-card title="Tidak Tersedia" :value="$unavailable" icon="ban" iconBgColor="bg-gray-100"
            iconTextColor="text-gray-600" />

    </div>

    @if (session('success_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: @json(session('success_message')),
                    icon: 'success',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    <div class="bg-white rounded-lg shadow">
        <x-vehicles.management-header title="Daftar Kendaraan" />
        <x-vehicles.filter-section />

        <x-vehicles.data-table>
            @foreach ($vehicles as $vehicle)
                <tr class="hover:bg-gray-50" id="vehicle-row-{{ $vehicle->id }}" data-category="{{ $vehicle->category }}"
                    data-status="{{ $vehicle->status }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded border-gray-300 text-gold focus:ring-gold" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : '/placeholder.svg?height=60&width=80&text=' . $vehicle->model }}"
                                alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                                class="w-16 h-12 rounded-lg object-cover" />
                            <div class="ml-4">
                                <div class="text-sm font-medium text-navy">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                                <div class="text-sm text-gray-custom">{{ $vehicle->license_plate }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ ucwords(str_replace('-', ' ', $vehicle->category)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-navy font-semibold">
                        Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
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
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            <button type="button" class="text-green-600 hover:text-green-900 edit-btn"
                                data-vehicle='@json($vehicle)' title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-vehicles.data-table>

        <div class="px-6 py-4">
            {{ $vehicles->links() }}
        </div>
    </div>
    <x-modals.add-vehicle />
    <x-modals.edit-vehicle />
@endsection

@push('scripts')
    <script>
        // Fungsi untuk menampilkan pesan kustom menggunakan SweetAlert2
        function showCustomMessage(message, type) {
            Swal.fire({
                text: message,
                icon: type, // 'info', 'warning', 'success', 'error'
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
        }

        // --- Fungsi Helper untuk Menangani Error Validasi Form ---
        function displayErrors(errors) {
            // Bersihkan semua error yang ada sebelumnya
            clearErrors();

            for (const field in errors) {
                if (errors.hasOwnProperty(field)) {
                    // Temukan input field
                    const inputElement = document.getElementById(field);
                    if (inputElement) {
                        inputElement.classList.add('border-red-500'); // Tambahkan border merah
                    }

                    // Temukan elemen untuk menampilkan pesan error (komponen input-error Anda)
                    // Asumsi komponen input-error Anda membuat div setelah input dengan class tertentu atau id yang bisa ditarget
                    // Atau, jika komponen x-forms.input-error Anda ada di dekat input:
                    const errorElement = document.querySelector(`[name="${field}"] + .text-red-600`);
                    if (errorElement) {
                        errorElement.innerHTML = ''; // Bersihkan pesan lama
                        errors[field].forEach(message => {
                            const p = document.createElement('p');
                            p.textContent = message;
                            errorElement.appendChild(p);
                        });
                    } else {
                        // Fallback jika tidak ditemukan elemen error khusus, bisa append di bawah input
                        const parentDiv = inputElement ? inputElement.closest('div') : null;
                        if (parentDiv) {
                            const newErrorDiv = document.createElement('div');
                            newErrorDiv.className = 'text-sm text-red-600 mt-2 validation-error-message';
                            errors[field].forEach(message => {
                                const p = document.createElement('p');
                                p.textContent = message;
                                newErrorDiv.appendChild(p);
                            });
                            parentDiv.appendChild(newErrorDiv);
                        }
                    }
                }
            }
            // Khusus untuk error array seperti features[] atau gallery_images[]
            for (const key in errors) {
                if (key.includes('.') && errors.hasOwnProperty(key)) {
                    const baseField = key.split('.')[0];
                    const errorElement = document.querySelector(`[name="${baseField}[]"] + .text-red-600`);
                    if (errorElement) {
                        errorElement.innerHTML = ''; // Bersihkan pesan lama
                        errors[key].forEach(message => {
                            const p = document.createElement('p');
                            p.textContent = message;
                            errorElement.appendChild(p);
                        });
                    }
                }
            }
        }

        function clearErrors() {
            document.querySelectorAll('.border-red-500').forEach(el => {
                el.classList.remove('border-red-500');
            });
            document.querySelectorAll('.text-red-600').forEach(el => {
                el.innerHTML = ''; // Clear all error messages
            });
            document.querySelectorAll('.validation-error-message').forEach(el => {
                el.remove(); // Remove dynamically added error messages
            });
        }
        // --- Akhir Fungsi Helper ---


        // Modal functionality for Add Vehicle
        const addVehicleBtn = document.getElementById("addVehicleBtn");
        const addVehicleModal = document.getElementById("addVehicleModal");
        const closeModal = document.getElementById("closeModal");
        const cancelModal = document.getElementById("cancelModal");
        const addVehicleForm = document.getElementById("addVehicleForm");


        function openAddVehicleModal() {
            if (addVehicleModal) {
                clearErrors(); // Bersihkan error setiap kali modal dibuka
                addVehicleForm.reset(); // Reset form setiap kali modal dibuka
                addVehicleModal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            }
        }

        function closeAddVehicleModal() {
            if (addVehicleModal) {
                addVehicleModal.classList.add("hidden");
                document.body.style.overflow = "auto";
            }
        }

        if (addVehicleBtn) {
            addVehicleBtn.addEventListener("click", openAddVehicleModal);
        }
        if (closeModal) {
            closeModal.addEventListener("click", closeAddVehicleModal);
        }
        if (cancelModal) {
            cancelModal.addEventListener("click", closeAddVehicleModal);
        }
        if (addVehicleModal) {
            addVehicleModal.addEventListener("click", (e) => {
                if (e.target === addVehicleModal) {
                    closeAddVehicleModal();
                }
            });
        }

        // === START: AJAX Form Submission for Add Vehicle ===
        if (addVehicleForm) {
            addVehicleForm.addEventListener("submit", async function(e) {
                e.preventDefault(); // Mencegah pengiriman form default

                showCustomMessage("Menyimpan kendaraan...", "info"); // Pesan loading

                clearErrors(); // Bersihkan error sebelumnya sebelum submit

                const formData = new FormData(this); // Mengambil semua data form, termasuk file
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content'); // Ambil CSRF token
                formData.append('_token', csrfToken); // Tambahkan CSRF token secara manual

                try {
                    const response = await fetch(this.action, {
                        method: 'POST',
                        body: formData, // Mengirim FormData
                        headers: {
                            'Accept': 'application/json', // Memberi tahu server kita mengharapkan JSON
                            'X-Requested-With': 'XMLHttpRequest', // Mengindikasikan ini adalah permintaan AJAX
                        }
                    });

                    const result = await response.json();

                    if (response.ok) { // Status 2xx (e.g., 200 OK, 201 Created)
                        showCustomMessage(result.message, "success");
                        closeAddVehicleModal();
                        // Anda bisa memperbarui tabel di sini tanpa reload,
                        // atau cukup reload halaman untuk menyederhanakan
                        location.reload(); // Reload halaman untuk melihat data baru
                    } else if (response.status === 422) { // Validasi gagal
                        showCustomMessage("Terjadi kesalahan validasi. Mohon periksa kembali input Anda.",
                            "error");
                        displayErrors(result.errors); // Tampilkan error yang diterima dari server
                    } else { // Error lain (e.g., 500 Internal Server Error)
                        showCustomMessage(result.message || "Terjadi kesalahan server.", "error");
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showCustomMessage("Terjadi kesalahan jaringan atau sistem.", "error");
                }
            });

            // Tambahkan event listener untuk membersihkan error saat input berubah
            addVehicleForm.querySelectorAll('input, select, textarea').forEach(input => {
                input.addEventListener('input', function() {
                    const fieldName = this.name.replace('[]',
                    ''); // Untuk array input, gunakan nama field dasar
                    const errorElement = document.querySelector(`[name="${fieldName}"] + .text-red-600`) ||
                        document.querySelector(`[name="${this.name}"] + .text-red-600`) ||
                        this.closest('div').querySelector(
                        '.validation-error-message'); // Fallback for dynamic errors

                    if (errorElement) {
                        errorElement.innerHTML = '';
                    }
                    this.classList.remove('border-red-500');
                });
            });
        }
        // === END: AJAX Form Submission for Add Vehicle ===

        // Modal functionality for Edit Vehicle (jika ingin diubah ke AJAX juga, logikanya mirip)
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

        document.querySelectorAll("#cancelEditModal, #closeEditModal").forEach(btn => {
            btn.addEventListener("click", () => {
                document.getElementById("editVehicleModal").classList.add("hidden");
                document.body.style.overflow = "auto";
                clearErrors(); // Clear errors on modal close
            });
        });

        // Form submission (Update Vehicle)
        const editVehicleForm = document.getElementById("editVehicleForm");
        if (editVehicleForm) {
            editVehicleForm.addEventListener("submit", async function(e) {
                e.preventDefault(); // Mencegah pengiriman form default

                showCustomMessage("Memperbarui kendaraan...", "info");

                clearErrors();

                const formData = new FormData(this);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                formData.append('_token', csrfToken); // Tambahkan CSRF token secara manual
                formData.append('_method', 'PUT'); // Penting untuk PUT request

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
                        displayErrors(result.errors);
                    } else {
                        showCustomMessage(result.message || "Terjadi kesalahan server.", "error");
                    }
                } catch (error) {
                    console.error('Error:', error);
                    showCustomMessage("Terjadi kesalahan jaringan atau sistem.", "error");
                }
            });

            // Tambahkan event listener untuk membersihkan error saat input berubah di form edit
            editVehicleForm.querySelectorAll('input, select, textarea').forEach(input => {
                input.addEventListener('input', function() {
                    const fieldName = this.name.replace('[]',
                    ''); // For array inputs, use the base field name
                    const errorElement = document.querySelector(`[name="${fieldName}"] + .text-red-600`) ||
                        document.querySelector(`[name="${this.name}"] + .text-red-600`) ||
                        this.closest('div').querySelector('.validation-error-message');

                    if (errorElement) {
                        errorElement.innerHTML = '';
                    }
                    this.classList.remove('border-red-500');
                });
            });
        }


        // Handle semua form hapus
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

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
                        form.submit();
                    }
                });
            });
        });

        // Search and Filter functionality
        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const statusFilter = document.getElementById("statusFilter");
        const resetFilters = document.getElementById("resetFilters");

        function filterTable() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            const selectedCategory = categoryFilter ? categoryFilter.value : '';
            const selectedStatus = statusFilter ? statusFilter.value : '';

            const rows = document.querySelectorAll("#vehicleTableBody tr");

            rows.forEach((row) => {
                const vehicleName = row.querySelector(".text-navy") ? row.querySelector(".text-navy").textContent
                    .toLowerCase() : '';
                const category = row.dataset.category ? row.dataset.category.toLowerCase() : '';
                const status = row.dataset.status ? row.dataset.status.toLowerCase() : '';

                let showRow = true;

                if (searchTerm && !vehicleName.includes(searchTerm)) {
                    showRow = false;
                }

                if (selectedCategory && category !== selectedCategory) {
                    showRow = false;
                }

                if (selectedStatus && status !== selectedStatus) {
                    showRow = false;
                }
                row.style.display = showRow ? "" : "none";
            });
        }

        if (searchInput) searchInput.addEventListener("input", filterTable);
        if (categoryFilter) categoryFilter.addEventListener("change", filterTable);
        if (statusFilter) statusFilter.addEventListener("change", filterTable);
        if (resetFilters) resetFilters.addEventListener("click", () => {
            if (searchInput) searchInput.value = "";
            if (categoryFilter) categoryFilter.value = "";
            if (statusFilter) statusFilter.value = "";
            filterTable();
        });

        // Select all functionality
        const selectAll = document.getElementById("selectAll");
        const checkboxes = document.querySelectorAll('#vehicleTableBody input[type="checkbox"]');

        if (selectAll) {
            selectAll.addEventListener("change", () => {
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = selectAll.checked;
                });
            });
        }
    </script>
@endpush

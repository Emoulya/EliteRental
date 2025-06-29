{{-- resources/views/admin/vehicles.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kendaraan - Elite Rental Admin')
@section('page_title', 'Manajemen Kendaraan')

@section('content')
    <!-- Statistics Cards -->
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

    @if (session('custom_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showCustomMessage(
                    @json(session('custom_message')['message']),
                    @json(session('custom_message')['type'] ?? 'info')
                );
            });
        </script>
    @endif

    <!-- Vehicle Management Section -->
    <div class="bg-white rounded-lg shadow">
        <x-vehicles.management-header title="Daftar Kendaraan" />
        <x-vehicles.filter-section />

        <x-vehicles.data-table>
            @foreach ($vehicles as $vehicle)
                <tr class="hover:bg-gray-50">
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
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400 text-sm">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star{{ $vehicle->rating >= $i ? '' : '-o' }}"></i>
                                @endfor
                            </div>
                            <span class="ml-1 text-sm text-gray-custom">{{ $vehicle->rating ?? '0.0' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <!-- Tombol Detail -->
                            <button class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>

                            <!-- Tombol Edit -->
                            <button class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Tombol Hapus (Form) -->
                            <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-vehicles.data-table>

        <x-pagination /> {{-- Ini adalah komponen pagination Anda --}}
    </div>
    <x-modals.add-vehicle />
@endsection

@push('scripts')
    <script>
        // Pastikan showCustomMessage dideklarasikan di sini atau di file JS utama
        // dan sudah dipanggil oleh @stack('scripts') di layout.
        // Jika komponen messageBox Anda belum dipanggil di layout, panggil di sini
        // atau biarkan di layout dan pastikan Alpinejs dimuat
        // untuk event click.outside pada modal.

        // Modal functionality
        const addVehicleBtn = document.getElementById("addVehicleBtn");
        const addVehicleModal = document.getElementById("addVehicleModal");
        const closeModal = document.getElementById("closeModal");
        const cancelModal = document.getElementById("cancelModal");

        if (addVehicleBtn && addVehicleModal && closeModal && cancelModal) {
            addVehicleBtn.addEventListener("click", () => {
                addVehicleModal.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            });

            function closeModalFunction() {
                addVehicleModal.classList.add("hidden");
                document.body.style.overflow = "auto";
            }

            closeModal.addEventListener("click", closeModalFunction);
            cancelModal.addEventListener("click", closeModalFunction);

            // Close modal when clicking outside
            addVehicleModal.addEventListener("click", (e) => {
                if (e.target === addVehicleModal) {
                    closeModalFunction();
                }
            });
        }

        // Form submission
        addVehicleForm.addEventListener("submit", (e) => {
            // Jangan blok pengiriman form
            // Biarkan form submit seperti biasa ke controller Laravel

            // Optional: tampilkan loading/pesan sebelum redirect
            if (typeof showCustomMessage === 'function') {
                showCustomMessage("Menyimpan kendaraan...", "info");
            }

            // Biarkan Laravel yang redirect dan menampilkan pesan sukses
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
                const categoryElement = row.querySelector(".px-2.py-1"); // Asumsi kategori adalah span pertama
                const category = categoryElement ? categoryElement.textContent.toLowerCase() : '';
                const statusElements = row.querySelectorAll(".px-2.py-1"); // Asumsi status adalah span kedua
                const status = statusElements.length > 1 ? statusElements[1].textContent.toLowerCase() : '';

                let showRow = true;

                if (searchTerm && !vehicleName.includes(searchTerm)) {
                    showRow = false;
                }

                if (selectedCategory && !category.includes(selectedCategory.replace("-", " "))) {
                    showRow = false;
                }

                if (selectedStatus) {
                    let actualStatusText = "";
                    if (selectedStatus === "tersedia") {
                        actualStatusText = "tersedia";
                    } else if (selectedStatus === "disewa") {
                        actualStatusText = "disewa";
                    } else if (selectedStatus === "maintenance") {
                        actualStatusText = "maintenance";
                    } else if (selectedStatus === "unavailable") {
                        actualStatusText = "unavailable";
                    } // Tambahkan ini

                    if (!status.includes(actualStatusText)) {
                        showRow = false;
                    }
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

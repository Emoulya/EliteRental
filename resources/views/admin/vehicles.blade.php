{{-- resources/views/admin/vehicles.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kendaraan - Elite Rental Admin')
@section('page_title', 'Manajemen Kendaraan')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <x-statistics.stat-card title="Total Unit" :value="$totalUnits" icon="car" iconBgColor="bg-blue-100"
            iconTextColor="text-blue-600" />
        <x-statistics.stat-card title="Tersedia" :value="$tersediaUnits" icon="check-circle" iconBgColor="bg-green-100"
            iconTextColor="text-green-600" />
        <x-statistics.stat-card title="Disewa" :value="$disewaUnits" icon="times-circle" iconBgColor="bg-red-100"
            iconTextColor="text-red-600" />
        <x-statistics.stat-card title="Maintenance" :value="$maintenanceUnits" icon="tools" iconBgColor="bg-yellow-100"
            iconTextColor="text-yellow-600" />
        <x-statistics.stat-card title="Tidak Tersedia" :value="$unavailableUnits" icon="ban" iconBgColor="bg-gray-100"
            iconTextColor="text-gray-600" />
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-medium text-navy">
                    Daftar Kendaraan (Model)
                </h3>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.vehicles.create') }}"
                        class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Model Kendaraan
                    </a>
                    <x-buttons.secondary-button>
                        <i class="fas fa-download mr-2"></i>
                        Export
                    </x-buttons.secondary-button>
                </div>
            </div>
        </div>

        <x-vehicles.filter-section />

        <x-vehicles.data-table>
            {{-- Isi tbody akan dimuat oleh partial Blade --}}
            @include('admin.vehicles._table_rows', ['vehicles' => $vehicles])
        </x-vehicles.data-table>

        <div id="paginationLinks" class="px-6 py-4">
            {{ $vehicles->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi SweetAlert2 pada Delete Form
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                // Panggil fungsi generik
                confirmAndDelete(form, 'Yakin ingin menghapus?',
                    'Data kendaraan akan dihapus secara permanen!');
            });
        });

        // --- AJAX Filtering Logic ---
        const filterForm = document.getElementById('adminVehicleFilterForm');
        const vehicleTableBody = document.getElementById('vehicleTableBody');
        const paginationLinksContainer = document.getElementById('paginationLinks');
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const statusFilter = document.getElementById('statusFilter');
        const priceFilter = document.getElementById('priceFilter');
        const resetFiltersBtn = document.getElementById('resetFilters');

        let debounceTimeout;

        // Fungsi debounce
        function debounce(func, delay) {
            return function(...args) {
                const context = this;
                clearTimeout(debounceTimeout);
                debounceTimeout = setTimeout(() => func.apply(context, args), delay);
            };
        }

        // Fungsi untuk mengaplikasikan filter (dipanggil saat input berubah)
        function applyFilters() {
            const formData = new FormData(filterForm);
            const queryString = new URLSearchParams(formData).toString();
            const url = `${filterForm.action}?${queryString}`;

            fetchFilteredVehicles(url);
        }

        // Fungsi untuk melakukan permintaan AJAX dan memperbarui tabel
        async function fetchFilteredVehicles(url) {
            try {
                const response = await fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const result = await response.json();

                // Perbarui isi tabel
                vehicleTableBody.innerHTML = result.table_html;
                // Perbarui link paginasi
                paginationLinksContainer.innerHTML = result.pagination_html;

            } catch (error) {
                console.error('Error fetching filtered vehicles:', error);
            }
        }

        // Event listener untuk input pencarian (dengan debounce)
        if (searchInput) {
            searchInput.addEventListener('input', debounce(function() {
                applyFilters();
            }, 500));
        }

        // Event listener untuk dropdown kategori
        if (categoryFilter) {
            categoryFilter.addEventListener('change', function() {
                applyFilters();
            });
        }

        // Event listener untuk dropdown status
        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                applyFilters();
            });
        }

        // Event listener untuk dropdown harga
        if (priceFilter) {
            priceFilter.addEventListener('change', function() {
                applyFilters();
            });
        }

        // Event listener untuk tombol Reset Filter
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                // Kosongkan semua input filter
                searchInput.value = '';
                categoryFilter.value = '';
                statusFilter.value = '';
                priceFilter.value = '';

                applyFilters();
            });
        }

        // Menambahkan event listener untuk link paginasi yang baru dimuat
        if (paginationLinksContainer) {
            paginationLinksContainer.addEventListener('click', function(e) {
                if (e.target.tagName === 'A' && e.target.closest(
                        '.pagination')) {
                    e.preventDefault();

                    const url = e.target.href;
                    fetchFilteredVehicles(url);
                }
            });
        }

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

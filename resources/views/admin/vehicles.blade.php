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

    @if (session('error_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: 'Gagal!',
                    text: @json(session('error_message')),
                    icon: 'error',
                    confirmButtonText: 'OK',
                    timer: 3000,
                    timerProgressBar: true
                });
            });
        </script>
    @endif

    <div class="bg-white rounded-lg shadow">
        {{-- Mengubah button Tambah Kendaraan menjadi link ke halaman baru --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-medium text-navy">
                    Daftar Kendaraan
                </h3>
                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.vehicles.create') }}"
                        class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Kendaraan
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
                            {{-- Icon Mata (Lihat Detail) --}}
                            <a href="{{ route('admin.vehicles.show', $vehicle->id) }}"
                                class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- Tombol Edit mengarah ke halaman baru --}}
                            <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}"
                                class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- Form Hapus (tetap sama) --}}
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
@endsection

@push('scripts')
    <script>
        // Fungsi untuk menampilkan pesan kustom menggunakan SweetAlert2
        function showCustomMessage(message, type) {
            Swal.fire({
                text: message,
                icon: type,
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

        // --- Fungsi Helper untuk Menangani Error Validasi Form (Jika masih ada form AJAX lain) ---
        // (Tetap pertahankan jika ada form lain yang masih menggunakan AJAX)
        function displayErrors(errors) {
            clearErrors();
            for (const field in errors) {
                if (errors.hasOwnProperty(field)) {
                    const inputElements = document.querySelectorAll(`[name="${field}"], [name="${field}[]"]`);
                    inputElements.forEach(inputElement => {
                        if (inputElement) {
                            inputElement.classList.add('border-red-500');
                            let errorElement = inputElement.nextElementSibling;
                            if (!errorElement || (!errorElement.classList.contains('text-red-600') && !errorElement
                                    .classList.contains('validation-error-list'))) {
                                errorElement = inputElement.closest('div').querySelector(
                                    '.validation-error-list, .validation-error-message');
                            }
                            if (errorElement) {
                                errorElement.innerHTML = '';
                                errors[field].forEach(message => {
                                    const p = document.createElement('p');
                                    p.textContent = message;
                                    errorElement.appendChild(p);
                                });
                            } else {
                                const parentDiv = inputElement.closest('div');
                                if (parentDiv) {
                                    const newErrorDiv = document.createElement('div');
                                    newErrorDiv.className = 'text-sm text-red-600 mt-2 validation-error-message';
                                    errors[field].forEach(message => {
                                        const p = document.createElement('p');
                                        p.textContent = message;
                                        newErrorDiv.appendChild(p);
                                    });
                                    inputElement.insertAdjacentElement('afterend', newErrorDiv);
                                }
                            }
                        }
                    });
                }
            }
        }

        function clearErrors() {
            document.querySelectorAll('.border-red-500').forEach(el => {
                el.classList.remove('border-red-500');
            });
            document.querySelectorAll('.validation-error-list').forEach(el => {
                el.innerHTML = '';
            });
            document.querySelectorAll('.validation-error-message').forEach(el => {
                el.remove();
            });
        }

        // Handle semua form hapus (tetap dipertahankan)
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

        // Search and Filter functionality (tetap dipertahankan)
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

        // Select all functionality (tetap dipertahankan)
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

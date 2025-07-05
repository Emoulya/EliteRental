@extends('layouts.app')

@section('title', 'Daftar Kendaraan - Elite Rental')

@section('content')
    <section class="bg-navy pt-20 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    Daftar <span class="text-gold">Kendaraan</span>
                </h1>
                <p class="text-xl text-gray-300 mb-8">
                    Pilih kendaraan yang sesuai dengan kebutuhan perjalanan Anda
                </p>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
        </div>
    </section>

    <section class="py-8 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-public.vehicle-filter /> {{-- Menggunakan komponen filter baru --}}

            <div class="flex justify-between items-center mt-6">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-custom">Tampilan:</span>
                    <button id="gridView"
                        class="p-2 bg-gold text-navy rounded hover:bg-yellow-500 transition duration-300">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button id="listView"
                        class="p-2 bg-gray-200 text-gray-custom rounded hover:bg-gray-300 transition duration-300">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
                <div class="text-gray-custom">
                    <span id="vehicleCount">{{ $vehicles->total() }}</span> kendaraan ditemukan
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="vehicleGrid" class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                {{-- Loop melalui data kendaraan yang diteruskan dari controller (initially loaded) --}}
                @include('partials.vehicle_cards', ['vehicles' => $vehicles])
            </div>

            <div class="text-center mt-12" id="paginationSection">
                @if ($vehicles->hasMorePages())
                    <button id="loadMoreButton"
                        class="bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105"
                        data-next-page="{{ $vehicles->nextPageUrl() }}">
                        Muat Lebih Banyak
                    </button>
                @else
                    <p class="text-gray-custom" id="noMoreVehiclesMessage">Semua kendaraan telah ditampilkan.</p>
                @endif
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const searchInput = document.getElementById("searchInput");
            const categoryFilter = document.getElementById("categoryFilter");
            const priceFilter = document.getElementById("priceFilter");
            const availabilityFilter = document.getElementById("availabilityFilter");
            const resetFiltersBtn = document.getElementById("resetFilters");
            const publicVehicleFilterForm = document.getElementById("publicVehicleFilterForm");

            const vehicleCountSpan = document.getElementById("vehicleCount");
            const gridViewButton = document.getElementById("gridView");
            const listViewButton = document.getElementById("listView");
            const vehicleGridContainer = document.getElementById("vehicleGrid");
            const loadMoreButton = document.getElementById("loadMoreButton");
            const paginationSection = document.getElementById("paginationSection");
            const noMoreVehiclesMessage = document.getElementById("noMoreVehiclesMessage");

            let debounceTimeout;

            function showLoading(message = 'Memuat...') {
                // Implementasi sederhana untuk menunjukkan loading, bisa diganti dengan SweetAlert2 atau spinner
                if (loadMoreButton) {
                    loadMoreButton.textContent = message;
                    loadMoreButton.disabled = true;
                }
                // Opsional: tampilkan overlay loading di seluruh halaman
            }

            function hideLoading(originalText = 'Muat Lebih Banyak') {
                if (loadMoreButton) {
                    loadMoreButton.textContent = originalText;
                    loadMoreButton.disabled = false;
                }
                // Opsional: sembunyikan overlay loading
            }

            async function fetchVehicles(url, append = false) {
                showLoading('Memuat kendaraan...');

                try {
                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest', // Penting untuk permintaan AJAX Laravel
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();

                    if (append) {
                        vehicleGridContainer.insertAdjacentHTML('beforeend', result.vehicle_cards_html);
                    } else {
                        vehicleGridContainer.innerHTML = result.vehicle_cards_html;
                    }

                    vehicleCountSpan.textContent = result.total_vehicles;

                    // Update "Load More" button or message
                    if (result.pagination_html) {
                        paginationSection.innerHTML = result.pagination_html;
                        // Re-attach event listener for new load more button if it exists
                        const newLoadMoreButton = document.getElementById('loadMoreButton');
                        if (newLoadMoreButton) {
                            newLoadMoreButton.removeEventListener('click',
                            handleLoadMoreClick); // Hapus event listener lama
                            newLoadMoreButton.addEventListener('click', handleLoadMoreClick); // Tambahkan yang baru
                            if (noMoreVehiclesMessage) noMoreVehiclesMessage.remove(); // Hapus pesan jika ada
                        } else {
                            // Jika tidak ada tombol load more, tampilkan pesan semua data
                            if (noMoreVehiclesMessage) noMoreVehiclesMessage.remove(); // Pastikan pesan lama dihapus
                            const endMessage = document.createElement('p');
                            endMessage.className = 'text-gray-custom';
                            endMessage.id = 'noMoreVehiclesMessage';
                            endMessage.textContent = 'Semua kendaraan telah ditampilkan.';
                            paginationSection.appendChild(endMessage);
                        }
                    } else {
                        paginationSection.innerHTML = ''; // Clear pagination
                        const endMessage = document.createElement('p');
                        endMessage.className = 'text-gray-custom';
                        endMessage.id = 'noMoreVehiclesMessage';
                        endMessage.textContent = 'Semua kendaraan telah ditampilkan.';
                        paginationSection.appendChild(endMessage);
                    }

                    hideLoading();

                } catch (error) {
                    console.error('Error fetching vehicles:', error);
                    hideLoading();
                    // showCustomMessage('Gagal memuat kendaraan. Silakan coba lagi.', 'error'); // Jika menggunakan custom-message
                    alert('Gagal memuat kendaraan. Silakan coba lagi.');
                }
            }

            function applyFilters() {
                const formData = new FormData(publicVehicleFilterForm);
                const queryString = new URLSearchParams(formData).toString();
                const url = `${publicVehicleFilterForm.action}?${queryString}`;
                fetchVehicles(url, false); // false = jangan append, ganti konten
            }

            function handleLoadMoreClick() {
                const nextPageUrl = this.dataset.nextPage;
                if (nextPageUrl) {
                    fetchVehicles(nextPageUrl, true); // true = append, tambahkan ke konten yang sudah ada
                }
            }


            // Event listener untuk input pencarian (dengan debounce)
            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(applyFilters, 500);
                });
            }

            // Event listeners untuk dropdown filter
            categoryFilter.addEventListener('change', applyFilters);
            priceFilter.addEventListener('change', applyFilters);
            availabilityFilter.addEventListener('change', applyFilters);

            // Event listener untuk tombol Reset Filter
            if (resetFiltersBtn) {
                resetFiltersBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    categoryFilter.value = '';
                    priceFilter.value = '';
                    availabilityFilter.value = '';
                    applyFilters(); // Panggil filter setelah reset
                });
            }

            // Event listener untuk tombol Load More (awalnya)
            if (loadMoreButton) {
                loadMoreButton.addEventListener('click', handleLoadMoreClick);
            }

            // View toggle functionality (tetap client-side)
            gridViewButton.addEventListener("click", () => {
                vehicleGridContainer.className = "grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6";
                gridViewButton.className = "p-2 bg-gold text-navy rounded hover:bg-yellow-500 transition duration-300";
                listViewButton.className =
                    "p-2 bg-gray-200 text-gray-custom rounded hover:bg-gray-300 transition duration-300";
            });

            listViewButton.addEventListener("click", () => {
                vehicleGridContainer.className = "grid grid-cols-1 gap-6";
                listViewButton.className = "p-2 bg-gold text-navy rounded hover:bg-yellow-500 transition duration-300";
                gridViewButton.className =
                    "p-2 bg-gray-200 text-gray-custom rounded hover:bg-gray-300 transition duration-300";
            });
        </script>
    @endpush
@endsection

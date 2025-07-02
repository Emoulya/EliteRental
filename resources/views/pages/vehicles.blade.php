@extends('layouts.app')

@section('title', 'Daftar Kendaraan - Elite Rental')

@section('content')
    <!-- Header Section -->
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

    <!-- Search and Filter Section -->
    <section class="py-8 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-4 mb-6">
                <!-- Search -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari kendaraan..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>

                <!-- Category Filter -->
                <select id="categoryFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Kategori</option>
                    <option value="mobil-keluarga">Mobil Keluarga</option>
                    <option value="mobil-mewah">Mobil Mewah</option>
                    <option value="motor">Motor</option>
                    <option value="pickup">Pick Up</option>
                    {{-- Anda bisa mengisi opsi ini secara dinamis dari database jika kategori disimpan di tabel terpisah --}}
                </select>

                <!-- Price Filter -->
                <select id="priceFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Harga</option>
                    <option value="0-200000">
                        < Rp 200K</option>
                    <option value="200000-500000">Rp 200K - 500K</option>
                    <option value="500000-1000000">Rp 500K - 1Jt</option>
                    <option value="1000000-999999999">> Rp 1Jt</option>
                </select>

                <!-- Availability Filter -->
                <select id="availabilityFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Status</option>
                    <option value="available">Tersedia</option>
                    <option value="rented">Disewa</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
            </div>

            <!-- View Toggle -->
            <div class="flex justify-between items-center">
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
                    <span id="vehicleCount">0</span> kendaraan ditemukan
                </div>
            </div>
        </div>
    </section>

    <!-- Vehicle Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div id="vehicleGrid" class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                {{-- Loop melalui data kendaraan yang diteruskan dari controller --}}
                @forelse($vehicles as $vehicle)
                    {{-- Meneruskan objek model Vehicle langsung ke komponen --}}
                    @include('components.vehicle-card', ['vehicle' => $vehicle])
                @empty
                    <p class="col-span-full text-center text-gray-custom text-lg">Tidak ada kendaraan yang tersedia saat
                        ini.</p>
                @endforelse
            </div>

            <!-- Load More Button (jika menggunakan paginasi) -->
            {{-- Jika Anda menggunakan paginasi di VehicleListController (misal: Vehicle::paginate(12)),
                 Anda bisa mengaktifkan bagian ini untuk menampilkan link paginasi Laravel. --}}
            {{-- @if (isset($vehicles) && $vehicles instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="text-center mt-12">
                    {{ $vehicles->links() }}
                </div>
            @else --}}
            <div class="text-center mt-12">
                <button
                    class="bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105">
                    Muat Lebih Banyak
                </button>
            </div>
            {{-- @endif --}}
        </div>
    </section>

    <script>
        // Search and Filter Functionality
        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const priceFilter = document.getElementById("priceFilter");
        const availabilityFilter = document.getElementById("availabilityFilter");
        const vehicleCards = document.querySelectorAll(".vehicle-card");
        const vehicleCount = document.getElementById("vehicleCount");
        const gridView = document.getElementById("gridView");
        const listView = document.getElementById("listView");
        const vehicleGrid = document.getElementById("vehicleGrid");

        function filterVehicles() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedPrice = priceFilter.value;
            const selectedAvailability = availabilityFilter.value;
            let visibleCount = 0;

            vehicleCards.forEach((card) => {
                // Mengambil data dari data-attributes yang dipasang oleh Blade
                const title = card.querySelector("h3").textContent.toLowerCase();
                const category = card.dataset.category;
                const price = parseInt(card.dataset.price);
                const availability = card.dataset.availability;

                let showCard = true;

                // Search filter
                if (searchTerm && !title.includes(searchTerm)) {
                    showCard = false;
                }

                // Category filter
                if (selectedCategory && category !== selectedCategory) {
                    showCard = false;
                }

                // Price filter
                if (selectedPrice) {
                    const [minPrice, maxPrice] = selectedPrice.split("-").map(Number);
                    if (price < minPrice || (maxPrice && price > maxPrice)) {
                        showCard = false;
                    }
                }

                // Availability filter
                if (selectedAvailability && availability !== selectedAvailability) {
                    showCard = false;
                }

                if (showCard) {
                    card.style.display = "block";
                    visibleCount++;
                } else {
                    card.style.display = "none";
                }
            });

            vehicleCount.textContent = visibleCount;
        }

        // Event listeners for filters
        searchInput.addEventListener("input", filterVehicles);
        categoryFilter.addEventListener("change", filterVehicles);
        priceFilter.addEventListener("change", filterVehicles);
        availabilityFilter.addEventListener("change", filterVehicles);

        // View toggle functionality
        gridView.addEventListener("click", () => {
            vehicleGrid.className = "grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6";
            gridView.className = "p-2 bg-gold text-navy rounded hover:bg-yellow-500 transition duration-300";
            listView.className =
                "p-2 bg-gray-200 text-gray-custom rounded hover:bg-gray-300 transition duration-300";
        });

        listView.addEventListener("click", () => {
            vehicleGrid.className = "grid grid-cols-1 gap-6";
            listView.className = "p-2 bg-gold text-navy rounded hover:bg-yellow-500 transition duration-300";
            gridView.className =
                "p-2 bg-gray-200 text-gray-custom rounded hover:bg-gray-300 transition duration-300";
        });

        // Initial filter on page load to set correct count
        document.addEventListener('DOMContentLoaded', filterVehicles);
    </script>
@endsection

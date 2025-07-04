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
            <div class="grid md:grid-cols-4 gap-4 mb-6">
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari kendaraan..."
                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" />
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>

                <select id="categoryFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Kategori</option>
                    <option value="mobil-keluarga">Mobil Keluarga</option>
                    <option value="mobil-mewah">Mobil Mewah</option>
                    <option value="motor">Motor</option>
                    <option value="pickup">Pick Up</option>
                    {{-- Anda bisa mengisi opsi ini secara dinamis dari database jika kategori disimpan di tabel terpisah --}}
                </select>

                <select id="priceFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Harga</option>
                    <option value="0-200000">
                        < Rp 200K</option>
                    <option value="200000-500000">Rp 200K - 500K</option>
                    <option value="500000-1000000">Rp 500K - 1Jt</option>
                    <option value="1000000-999999999">> Rp 1Jt</option>
                </select>

                <select id="availabilityFilter"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold">
                    <option value="">Semua Status</option>
                    <option value="available">Tersedia</option>
                    <option value="rented">Disewa</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="unavailable">Tidak Tersedia</option>
                </select>
            </div>

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
                    <span id="vehicleCount">{{ $vehicles->total() }}</span> kendaraan ditemukan
                </div>
            </div>
        </div>
    </section>

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

            {{-- Menggunakan `links()` Laravel untuk menampilkan link paginasi.
                 Secara default ini akan menampilkan link angka, tapi kita bisa mengkostumisasinya
                 agar menjadi tombol "Muat Lebih Banyak" dengan AJAX. --}}
            @if ($vehicles->hasPages())
                <div class="text-center mt-12">
                    {{-- Tombol Muat Lebih Banyak --}}
                    @if ($vehicles->hasMorePages())
                        <button id="loadMoreButton"
                            class="bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105"
                            data-next-page="{{ $vehicles->nextPageUrl() }}">
                            Muat Lebih Banyak
                        </button>
                    @else
                        <p class="text-gray-custom">Semua kendaraan telah ditampilkan.</p>
                    @endif
                </div>
            @endif
        </div>
    </section>

    <script>
        const vehicleCountSpan = document.getElementById("vehicleCount");
        const gridViewButton = document.getElementById("gridView");
        const listViewButton = document.getElementById("listView");
        const vehicleGridContainer = document.getElementById("vehicleGrid");
        const loadMoreButton = document.getElementById("loadMoreButton");
        let currentPage = {{ $vehicles->currentPage() }}; // Inisialisasi halaman saat ini
        let totalVehicles = {{ $vehicles->total() }}; // Total kendaraan

        // Fungsi untuk memperbarui jumlah kendaraan yang ditampilkan
        function updateVehicleCount() {
            vehicleCountSpan.textContent = totalVehicles;
        }

        // View toggle functionality
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

        // Load More functionality
        if (loadMoreButton) {
            loadMoreButton.addEventListener("click", function() {
                const nextPageUrl = this.dataset.nextPage;

                if (nextPageUrl) {
                    // Disable tombol saat memuat
                    this.disabled = true;
                    this.textContent = 'Memuat...';

                    fetch(nextPageUrl, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest' // Penting untuk permintaan AJAX Laravel
                            }
                        })
                        .then(response => response.text()) // Ambil respon sebagai teks HTML
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');

                            // Ambil kartu kendaraan baru dari respon
                            const newVehicleCards = doc.querySelectorAll('.vehicle-card');
                            newVehicleCards.forEach(card => {
                                vehicleGridContainer.appendChild(card);
                            });

                            // Perbarui URL halaman berikutnya
                            const newLoadMoreButton = doc.getElementById('loadMoreButton');
                            if (newLoadMoreButton) {
                                this.dataset.nextPage = newLoadMoreButton.dataset.nextPage;
                            } else {
                                // Jika tidak ada tombol "Muat Lebih Banyak" di respon, berarti sudah halaman terakhir
                                this.remove(); // Hapus tombol
                                const endMessage = document.createElement('p');
                                endMessage.className = 'text-gray-custom';
                                endMessage.textContent = 'Semua kendaraan telah ditampilkan.';
                                vehicleGridContainer.parentElement.appendChild(
                                endMessage); // Tambahkan pesan di bawah grid
                            }

                            // Perbarui jumlah kendaraan (jika perlu)
                            // Untuk kasus ini, karena kita memuat semua vehicle-card baru, kita bisa mendapatkan jumlahnya
                            // Atau bisa juga memperbarui totalVehicles dari data paginasi yang dikirimkan.
                            // Untuk saat ini, kita biarkan `totalVehicles` dari nilai awal dari controller.
                            // Jika Anda ingin menampilkan "X dari Y" kendaraan, Anda perlu mendapatkan `total` dan `from`/`to`
                            // dari data paginasi AJAX juga.
                            totalVehicles = parseInt(doc.getElementById('vehicleCount').textContent);
                            updateVehicleCount();

                            // Aktifkan kembali tombol
                            this.disabled = false;
                            this.textContent = 'Muat Lebih Banyak';
                        })
                        .catch(error => {
                            console.error('Error loading more vehicles:', error);
                            this.disabled = false;
                            this.textContent = 'Muat Lebih Banyak'; // Kembalikan teks jika gagal
                            alert('Gagal memuat kendaraan. Silakan coba lagi.');
                        });
                }
            });
        }

        // Filter functionality (tetap dipertahankan untuk sisi klien, tapi akan lebih baik jika digabung dengan AJAX)
        const searchInput = document.getElementById("searchInput");
        const categoryFilter = document.getElementById("categoryFilter");
        const priceFilter = document.getElementById("priceFilter");
        const availabilityFilter = document.getElementById("availabilityFilter");

        function filterVehiclesDisplay() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedPrice = priceFilter.value;
            const selectedAvailability = availabilityFilter.value;
            let currentVisibleCount = 0;

            document.querySelectorAll(".vehicle-card").forEach((card) => {
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
                    currentVisibleCount++;
                } else {
                    card.style.display = "none";
                }
            });
            // Karena filter ini sisi klien, kita hanya memperbarui jumlah yang terlihat, bukan total dari database
            vehicleCountSpan.textContent = currentVisibleCount;
        }


        // Event listeners for filters
        searchInput.addEventListener("input", filterVehiclesDisplay);
        categoryFilter.addEventListener("change", filterVehiclesDisplay);
        priceFilter.addEventListener("change", filterVehiclesDisplay);
        availabilityFilter.addEventListener("change", filterVehiclesDisplay);

        // Initial update on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateVehicleCount(); // Update total kendaraan dari paginasi awal
            filterVehiclesDisplay(); // Terapkan filter tampilan awal
        });
    </script>
@endsection

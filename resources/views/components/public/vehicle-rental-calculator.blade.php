{{-- resources/views/components/public/vehicle-rental-calculator.blade.php --}}
@props(['vehicle'])

<div class="bg-white p-6 rounded-lg shadow-lg mb-6">
    <div class="flex items-center justify-between mb-4">
        <div>
            <span id="displayPrice" class="text-3xl font-bold text-gold">
                Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}
            </span>
            <span id="displayDurationLabel" class="text-gray-custom">/hari</span>
        </div>
        @if ($vehicle->original_daily_price && $vehicle->original_daily_price > $vehicle->daily_price)
            <div class="text-right">
                <div class="text-sm text-gray-custom line-through" id="originalPriceDisplay">
                    Rp {{ number_format($vehicle->original_daily_price, 0, ',', '.') }}
                </div>
                <div class="text-sm text-green-600 font-semibold" id="discountPercentage">
                    Hemat
                    {{ round((($vehicle->original_daily_price - $vehicle->daily_price) / $vehicle->original_daily_price) * 100) }}%
                </div>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-3 gap-2 mb-4">
        @if ($vehicle->daily_price)
            <div id="dailyOption" data-duration-type="daily" data-price="{{ $vehicle->daily_price }}"
                class="duration-option text-center p-2 border rounded hover:border-gold cursor-pointer transition duration-300 active-duration">
                <div class="font-semibold text-navy">Harian</div>
                <div class="text-sm text-gray-custom">Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}</div>
            </div>
        @endif
        @if ($vehicle->weekly_price)
            <div id="weeklyOption" data-duration-type="weekly" data-price="{{ $vehicle->weekly_price }}"
                class="duration-option text-center p-2 border rounded hover:border-gold cursor-pointer transition duration-300">
                <div class="font-semibold text-navy">Mingguan</div>
                <div class="text-sm text-gray-custom">Rp {{ number_format($vehicle->weekly_price, 0, ',', '.') }}</div>
            </div>
        @endif
        @if ($vehicle->monthly_price)
            <div id="monthlyOption" data-duration-type="monthly" data-price="{{ $vehicle->monthly_price }}"
                class="duration-option text-center p-2 border rounded hover:border-gold cursor-pointer transition duration-300">
                <div class="font-semibold text-navy">Bulanan</div>
                <div class="text-sm text-gray-custom">Rp {{ number_format($vehicle->monthly_price, 0, ',', '.') }}</div>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label for="quantityInput" id="quantityLabel" class="block text-navy font-semibold mb-2">Jumlah Hari</label>
        <input type="number" id="quantityInput" value="1" min="1"
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" />
    </div>

    <div class="flex items-center justify-between mb-6 border-t pt-4">
        <span class="text-lg font-semibold text-navy">Total Harga:</span>
        <span id="totalPriceDisplay" class="text-2xl font-bold text-gold">
            Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}
        </span>
    </div>

    <div class="mb-4">
        <label for="platOption" class="block text-navy font-semibold mb-2">Pilih Plat Nomor</label>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
            @php
                $availableUnits = $vehicle->units->where('status', 'tersedia');
            @endphp
            @forelse ($availableUnits as $unit)
                <label
                    class="flex items-center bg-white border rounded-lg px-3 py-2 cursor-pointer hover:border-gold transition">
                    <input type="radio" name="platOption" value="{{ $unit->license_plate }}"
                        class="form-radio text-gold mr-2" />
                    {{ $unit->license_plate }}
                </label>
            @empty
                <p class="col-span-full text-gray-500">Tidak ada unit tersedia untuk model ini.</p>
            @endforelse
        </div>
    </div>

    @if ($availableUnits->isNotEmpty())
        <button id="bookNowButton"
            class="w-full bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-6 rounded-lg text-lg transition duration-300 transform hover:scale-105">
            <i class="fas fa-calendar-check mr-2"></i>
            Pesan Sekarang
        </button>
    @else
        <button class="w-full bg-gray-400 text-white font-bold py-3 px-6 rounded-lg text-lg cursor-not-allowed"
            disabled>
            <i class="fas fa-ban mr-2"></i>
            Tidak Tersedia
        </button>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const durationOptions = document.querySelectorAll('.duration-option');
            const displayPrice = document.getElementById('displayPrice');
            const displayDurationLabel = document.getElementById('displayDurationLabel');
            const quantityInput = document.getElementById('quantityInput');
            const quantityLabel = document.getElementById('quantityLabel');
            const totalPriceDisplay = document.getElementById('totalPriceDisplay');
            const bookNowButton = document.getElementById('bookNowButton');
            const platOptionRadios = document.querySelectorAll(
            'input[name="platOption"]');

            const vehiclePrices = {
                daily: {{ $vehicle->daily_price ?? 0 }},
                weekly: {{ $vehicle->weekly_price ?? 0 }},
                monthly: {{ $vehicle->monthly_price ?? 0 }}
            };

            let currentDurationType = 'daily';
            let currentBasePrice = vehiclePrices.daily;
            let currentQuantity = parseInt(quantityInput.value);
            let selectedPlateNumber = null;

            function formatRupiah(number) {
                return 'Rp ' + number.toLocaleString('id-ID');
            }

            function updatePriceAndTotal() {
                let labelText = '';
                let durationUnit = '';
                switch (currentDurationType) {
                    case 'daily':
                        labelText = 'Jumlah Hari';
                        durationUnit = '/hari';
                        break;
                    case 'weekly':
                        labelText = 'Jumlah Minggu';
                        durationUnit = '/minggu';
                        break;
                    case 'monthly':
                        labelText = 'Jumlah Bulan';
                        durationUnit = '/bulan';
                        break;
                }
                quantityLabel.textContent = labelText;

                if (currentQuantity < 1) {
                    currentQuantity = 1;
                    quantityInput.value = 1;
                }

                displayPrice.textContent = formatRupiah(currentBasePrice);
                displayDurationLabel.textContent = durationUnit;

                let total = currentBasePrice * currentQuantity;
                totalPriceDisplay.textContent = formatRupiah(total);

                // Aktifkan/nonaktifkan tombol Pesan Sekarang berdasarkan pilihan plat
                updateBookNowButtonState();
            }

            function updateBookNowButtonState() {
                let isPlateSelected = false;
                platOptionRadios.forEach(radio => {
                    if (radio.checked) {
                        isPlateSelected = true;
                    }
                });

                if (bookNowButton) {
                    if (isPlateSelected) {
                        bookNowButton.disabled = false;
                        bookNowButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                        bookNowButton.classList.add('bg-gold', 'hover:bg-yellow-500', 'text-navy');
                    } else {
                        bookNowButton.disabled = true;
                        bookNowButton.classList.remove('bg-gold', 'hover:bg-yellow-500', 'text-navy');
                        bookNowButton.classList.add('bg-gray-400', 'cursor-not-allowed');
                    }
                }
            }


            durationOptions.forEach(option => {
                option.addEventListener('click', function() {
                    durationOptions.forEach(opt => opt.classList.remove('active-duration'));
                    this.classList.add('active-duration');

                    currentDurationType = this.dataset.durationType;
                    currentBasePrice = parseInt(this.dataset.price);

                    currentQuantity = 1;
                    quantityInput.value = 1;

                    updatePriceAndTotal();
                });
            });

            quantityInput.addEventListener('input', function() {
                currentQuantity = parseInt(this.value);
                if (isNaN(currentQuantity) || currentQuantity < 1) {
                    currentQuantity = 1;
                    this.value = 1;
                }
                updatePriceAndTotal();
            });

            // Event listener untuk radio button plat nomor
            platOptionRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        selectedPlateNumber = this.value;
                    }
                    updateBookNowButtonState();
                });
            });

            // Event listener untuk tombol "Pesan Sekarang"
            if (bookNowButton) {
                bookNowButton.addEventListener('click', function() {
                    // Validasi akhir sebelum submit
                    if (!selectedPlateNumber) {
                        alert('Mohon pilih plat nomor kendaraan.');
                        return;
                    }

                    const vehicleId = {{ $vehicle->id }}; // Ambil ID kendaraan
                    const quantity = currentQuantity;
                    const totalPrice = currentBasePrice *
                    currentQuantity; // Hitung ulang total untuk akurasi

                    // Buat URL dengan query parameters
                    const url =
                        `{{ route('booking.show') }}?vehicle_id=${vehicleId}&plate_number=${selectedPlateNumber}&duration_type=${currentDurationType}&quantity=${quantity}&total_price=${totalPrice}`;

                    window.location.href = url; // Arahkan ke halaman detail booking
                });
            }


            // Inisialisasi tampilan awal
            const initialDailyOption = document.getElementById('dailyOption');
            if (initialDailyOption) {
                initialDailyOption.classList.add('active-duration');
            }
            updatePriceAndTotal();
            updateBookNowButtonState();
        });
    </script>
    <style>
        /* CSS untuk menandai durasi yang aktif */
        .duration-option.active-duration {
            border-color: gold;
            /* Menggunakan variabel CSS untuk warna gold */
            background-color: gold;
            /* Menggunakan variabel CSS untuk warna gold */
            color: navy;
            /* Menggunakan variabel CSS untuk warna navy */
        }

        .duration-option.active-duration div {
            color: navy;
            /* Memastikan teks di dalamnya juga navy */
        }
    </style>
@endpush

{{-- resources\views\pages\payment.blade.php --}}
@extends('layouts.app')

@section('title', 'Elite Rental - Pembayaran')

@section('content')
    <section class="bg-white py-4 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-custom hover:text-gold">
                            <i class="fas fa-home mr-2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="{{ route('vehicles.index') }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">Kendaraan</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            {{-- Menggunakan objek booking untuk mendapatkan vehicle ID --}}
                            <a href="{{ route('vehicles.show_public', $booking->vehicleUnit->vehicle->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">
                                {{ $booking->vehicleUnit->vehicle->brand }}
                                {{ $booking->vehicleUnit->vehicle->model }}
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            {{-- Menggunakan objek booking untuk detail booking --}}
                            <a href="{{ route('booking.show', $booking->id) }}"
                                class="ml-1 text-sm font-medium text-gray-custom hover:text-gold md:ml-2">Detail Booking</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span class="ml-1 text-sm font-medium text-navy md:ml-2">Pembayaran</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <x-public.booking-timeline :currentStep="2" />

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Pilih Metode Pembayaran
                    </h2>

                    <div class="space-y-4">
                        <div class="border rounded-lg p-4 hover:border-navy transition-colors">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="bank_transfer"
                                    class="text-navy focus:ring-navy" checked /> {{-- Ubah value menjadi bank_transfer --}}
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-navy text-white rounded-lg flex items-center justify-center">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            Transfer Bank
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            BCA, BNI, BRI, Mandiri
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="border rounded-lg p-4 hover:border-navy transition-colors">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="e_wallet" {{-- Ubah value menjadi e_wallet --}}
                                    class="text-navy focus:ring-navy" />
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-green-500 text-white rounded-lg flex items-center justify-center">
                                        <i class="fas fa-wallet"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            E-Wallet
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            GoPay, OVO, Dana, ShopeePay
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <div class="border rounded-lg p-4 hover:border-navy transition-colors">
                            <label class="flex items-center space-x-3 cursor-pointer">
                                <input type="radio" name="payment_method" value="cash"
                                    class="text-navy focus:ring-navy" />
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-12 h-12 bg-orange-500 text-white rounded-lg flex items-center justify-center">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-slate-800">
                                            Bayar Tunai
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Bayar langsung saat pengambilan
                                        </p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md p-6" id="payment-instructions">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Instruksi Pembayaran
                    </h2>

                    <div id="bank_transfer-instructions" class="payment-instruction"> {{-- Ubah ID --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                            <h3 class="font-semibold text-blue-800 mb-2">
                                Transfer ke Rekening Berikut:
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between bg-white p-3 rounded">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_central_asia.svg/1200px-Bank_central_asia.svg.png"
                                            alt="BCA" class="w-8 h-8 object-contain" />
                                        <div>
                                            <p class="font-semibold">
                                                Bank BCA
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                1234567890
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                a.n. Elite Rental
                                            </p>
                                        </div>
                                    </div>
                                    <button class="text-navy hover:text-gold" onclick="copyText('1234567890')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between bg-white p-3 rounded">
                                    <div class="flex items-center space-x-3">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png"
                                            alt="BNI" class="w-8 h-8 object-contain" />
                                        <div>
                                            <p class="font-semibold">
                                                Bank BNI
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                0987654321
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                a.n. Elite Rental
                                            </p>
                                        </div>
                                    </div>
                                    <button class="text-navy hover:text-gold" onclick="copyText('0987654321')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <h4 class="font-semibold text-yellow-800 mb-2">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    Penting!
                                </h4>
                                <ul class="text-sm text-yellow-700 space-y-1">
                                    <li>
                                        • Transfer sesuai dengan nominal yang
                                        tertera <strong>Rp {{ number_format($finalTotalPrice, 0, ',', '.') }}</strong>
                                    </li>
                                    <li>
                                        • Simpan bukti transfer untuk verifikasi
                                    </li>
                                    <li>
                                        • Pembayaran akan diverifikasi dalam
                                        1x24 jam
                                    </li>
                                    <li>
                                        • Jika ada kendala, hubungi customer
                                        service kami
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="e_wallet-instructions" class="payment-instruction hidden"> {{-- Ubah ID --}}
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <h3 class="font-semibold text-green-800 mb-2">
                                Scan QR Code di bawah ini:
                            </h3>
                            <div class="flex justify-center mb-4">
                                <div
                                    class="w-48 h-48 bg-white border-2 border-green-300 rounded-lg flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-qrcode text-6xl text-green-500 mb-2"></i>
                                        <p class="text-sm text-gray-600">
                                            QR Code
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            Rp {{ number_format($finalTotalPrice, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <p class="text-sm text-green-700">
                                    Atau gunakan nomor Virtual Account:
                                </p>
                                <div class="bg-white p-3 rounded mt-2 flex items-center justify-between">
                                    <span class="font-mono text-lg">8856700001234567</span>
                                    <button class="text-navy hover:text-gold" onclick="copyText('8856700001234567')">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="cash-instructions" class="payment-instruction hidden">
                        <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                            <h3 class="font-semibold text-orange-800 mb-2">
                                Pembayaran Tunai
                            </h3>
                            <div class="space-y-3">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        1
                                    </div>
                                    <p class="text-sm text-orange-700">
                                        Siapkan uang tunai sebesar
                                        <strong>Rp {{ number_format($finalTotalPrice, 0, ',', '.') }}</strong>
                                    </p>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        2
                                    </div>
                                    <p class="text-sm text-orange-700">
                                        Bayar saat pengambilan kendaraan di
                                        lokasi yang telah ditentukan
                                    </p>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-8 h-8 bg-orange-500 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                        3
                                    </div>
                                    <p class="text-sm text-orange-700">
                                        Pastikan membawa dokumen identitas
                                        yang valid
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">
                        Ringkasan Pesanan
                    </h2>

                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">ID Pesanan</span>
                            <span class="font-mono text-sm font-bold">{{ $orderId }}</span>
                        </div>
                    </div>

                    <div class="border-b pb-4 mb-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                <img src="{{ $booking->vehicleUnit->vehicle->main_image ? asset('storage/' . $booking->vehicleUnit->vehicle->main_image) : asset('placeholder.svg?height=60&width=60&text=' . urlencode($booking->vehicleUnit->vehicle->model)) }}"
                                    alt="{{ $booking->vehicleUnit->vehicle->brand }} {{ $booking->vehicleUnit->vehicle->model }}"
                                    class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">
                                    {{ $booking->vehicleUnit->vehicle->brand }}
                                    {{ $booking->vehicleUnit->vehicle->model }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ ucwords(str_replace('-', ' ', $booking->vehicleUnit->vehicle->category)) }} •
                                    {{ $booking->vehicleUnit->vehicle->year }} •
                                    {{ $booking->vehicleUnit->vehicle->passenger_capacity }} Penumpang •
                                    {{ ucfirst($booking->vehicleUnit->vehicle->transmission_type) }} • Warna
                                    {{ $booking->vehicleUnit->vehicle->color }}
                                </p>
                                <div class="flex items-center space-x-2 mt-1">
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Tersedia</span>
                                    <span
                                        class="bg-gray-100 text-xs px-2 py-1 rounded">{{ $booking->vehicleUnit->license_plate }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-b pb-4 mb-4">
                        <h3 class="font-semibold text-slate-800 mb-2">
                            Data Penyewa
                        </h3>
                        <div class="space-y-1 text-sm">
                            <p>
                                <span class="text-gray-600">Nama:</span>
                                <span class="font-medium">{{ $booking->user->name ?? 'N/A' }}</span>
                            </p>
                            <p>
                                <span class="text-gray-600">Email:</span>
                                <span class="font-medium">{{ $booking->user->email ?? 'N/A' }}</span>
                            </p>
                            <p>
                                <span class="text-gray-600">No. HP:</span>
                                <span
                                    class="font-medium">{{ $booking->user->customerProfile->phone_number ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-medium">{{ $booking->quantity }}
                                {{ ucfirst($booking->duration_type) }}</span> {{-- Menggunakan data dari booking --}}
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Sewa</span>
                            <span class="font-medium">{{ $booking->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Pengembalian</span>
                            <span class="font-medium">{{ $booking->end_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sub Total</span>
                            <span class="font-medium">Rp {{ number_format($subTotalPrice, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pajak & Biaya Admin</span>
                            <span class="font-medium">Rp {{ number_format($taxAdminFee, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-slate-800">Total Pembayaran</span>
                                <span class="text-lg font-bold text-gold">Rp
                                    {{ number_format($finalTotalPrice, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                        <div class="flex items-center space-x-2 mb-2">
                            <i class="fas fa-clock text-red-500"></i>
                            <span class="text-red-700 font-semibold">Selesaikan pembayaran dalam:</span>
                        </div>
                        <div class="text-center">
                            <div id="countdown" class="text-2xl font-bold text-red-600">
                                {{-- Initial value will be set by JS --}}
                                Loading...
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button id="confirmPaymentButton" {{-- Ubah ID tombol --}}
                            class="w-full bg-gold hover:bg-yellow-600 text-navy font-bold py-3 px-4 rounded-lg transition duration-200">
                            <i class="fas fa-check mr-2"></i>
                            Konfirmasi Pembayaran
                        </button>
                        <button onclick="goBack()"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 px-4 rounded-lg transition duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Default radio button selection (jika belum ada yang dipilih)
        document.addEventListener('DOMContentLoaded', function() {
            const defaultPaymentMethod = document.querySelector('input[name="payment_method"]:checked');
            if (defaultPaymentMethod) {
                // Panggil event change secara manual untuk menampilkan instruksi default
                defaultPaymentMethod.dispatchEvent(new Event('change'));
            }
        });

        // Payment method selection
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const instructionDivs = document.querySelectorAll('.payment-instruction');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                instructionDivs.forEach(div => div.classList.add('hidden'));

                if (this.value === 'bank_transfer') { // Ubah case 'bank' menjadi 'bank_transfer'
                    document.getElementById('bank_transfer-instructions').classList.remove('hidden');
                } else if (this.value === 'e_wallet') { // Ubah case 'ewallet' menjadi 'e_wallet'
                    document.getElementById('e_wallet-instructions').classList.remove('hidden');
                } else if (this.value === 'cash') {
                    document.getElementById('cash-instructions').classList.remove('hidden');
                }
            });
        });

        // Copy text function
        function copyText(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Nomor berhasil disalin!');
            }).catch(function(error) {
                console.error('Gagal menyalin: ', error);
                alert('Gagal menyalin nomor.');
            });
        }

        // Countdown timer
        function startCountdown(expiryTime) {
            let endTime = new Date(expiryTime).getTime(); // Waktu kadaluarsa dalam milidetik

            const timerElement = document.getElementById('countdown');

            // Hentikan interval sebelumnya jika ada
            if (timerElement.dataset.timerInterval) {
                clearInterval(parseInt(timerElement.dataset.timerInterval));
            }

            const timerInterval = setInterval(function() {
                const now = new Date().getTime();
                const timeLeft = endTime - now; // Sisa waktu dalam milidetik

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    timerElement.textContent = '00:00:00';
                    alert('Waktu pembayaran telah habis. Silakan buat pesanan baru.');
                    return;
                }

                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                timerElement.textContent =
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            }, 1000);

            timerElement.dataset.timerInterval = timerInterval; // Simpan ID interval
        }


        // Go back (fungsi ini terpanggil oleh onclick)
        window.goBack = function() {
            window.history.back();
        };

        // Start countdown when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Pastikan paymentExpiry adalah string ISO 8601 yang valid
            const paymentExpiryTime = new Date("{{ $paymentExpiry->toIso8601String() }}");
            startCountdown(paymentExpiryTime);

            // Trigger change event on load for the initially checked radio button
            const initialCheckedMethod = document.querySelector('input[name="payment_method"]:checked');
            if (initialCheckedMethod) {
                initialCheckedMethod.dispatchEvent(new Event('change'));
            }
        });


        // === Logika untuk tombol Konfirmasi Pembayaran ===
        document.addEventListener('DOMContentLoaded', function() {
            const confirmPaymentButton = document.getElementById('confirmPaymentButton');
            const bookingId = {{ $booking->id }}; // Ambil ID booking dari Blade

            if (confirmPaymentButton) {
                confirmPaymentButton.addEventListener("click", async function(e) {
                    e.preventDefault();

                    const selectedMethod = document.querySelector(
                        'input[name="payment_method"]:checked');

                    if (!selectedMethod) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Mohon pilih metode pembayaran terlebih dahulu.',
                            confirmButtonColor: '#F4B000'
                        });
                        return;
                    }

                    showLoading('Memproses konfirmasi pembayaran...'); // Tampilkan loading

                    const formData = new FormData();
                    formData.append('payment_method', selectedMethod.value);
                    formData.append('_token', '{{ csrf_token() }}');
                    formData.append('_method',
                    'POST'); // Menggunakan POST untuk menyimpan Payment, atau PUT jika update status booking

                    try {
                        const response = await fetch(
                        `/booking/${bookingId}/confirm-payment`, { // Route baru untuk konfirmasi pembayaran
                            method: 'POST', // Kirim sebagai POST, Laravel akan mengenali _method jika ada PUT
                            body: formData,
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            const errorData = await response.json();
                            let errorMessage = errorData.message || 'Gagal mengkonfirmasi pembayaran.';
                            if (response.status === 422 && errorData.errors) {
                                errorMessage = Object.values(errorData.errors).flat().join('<br>');
                            }
                            showError(`Terjadi kesalahan:<br>${errorMessage}`);
                            return;
                        }

                        const result = await response.json();
                        showSuccess(result.message || 'Pembayaran berhasil dikonfirmasi!');
                        // Redirect ke halaman konfirmasi akhir
                        setTimeout(() => {
                            window.location.href =
                                `{{ route('booking.confirmation') }}?booking_id=${bookingId}&payment_method=${selectedMethod.value}`;
                        }, 1500);

                    } catch (error) {
                        console.error('Error saat konfirmasi pembayaran:', error);
                        showError('Gagal mengkonfirmasi pembayaran. Silakan coba lagi.');
                    } finally {
                        Swal.close(); // Tutup loading
                    }
                });
            }
        });
    </script>
@endpush

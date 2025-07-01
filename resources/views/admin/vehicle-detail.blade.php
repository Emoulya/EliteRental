{{-- resources/views/admin/vehicle-detail.blade.php --}}
@extends('layouts.admin')

{{-- Mengatur judul tab browser (dari $title di admin.blade.php) --}}
@section('title', 'Detail Kendaraan - Elite Rental')

{{-- Mengatur judul halaman utama yang akan ditampilkan oleh components.admin-header --}}
@section('page_title', 'Detail Kendaraan')


@section('content')
    {{-- Catatan: Bagian header utama halaman (dengan tombol kembali dan judul 'Detail Kendaraan')
         sekarang akan ditangani oleh components.admin-header di layout.
         Konten di sini akan langsung menjadi bagian utama setelah header layout. --}}

    {{-- Contoh: Jika Anda ingin judul spesifik kendaraan, letakkan di sini --}}
    {{-- <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-xl font-bold text-navy">Toyota Avanza</h3>
        </div>
    </div> --}}

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
                        <img id="mainImage" src="/placeholder.svg?height=300&width=500&text=Toyota+Avanza+Main"
                            alt="Toyota Avanza" class="w-full h-64 rounded-lg object-cover" />
                    </div>
                    <div class="flex space-x-2 overflow-x-auto">
                        <img src="/placeholder.svg?height=80&width=120&text=Front" alt="Front View"
                            class="w-20 h-16 rounded cursor-pointer hover:opacity-75 transition duration-300 flex-shrink-0"
                            onclick="changeMainImage(this.src)" />
                        <img src="/placeholder.svg?height=80&width=120&text=Side" alt="Side View"
                            class="w-20 h-16 rounded cursor-pointer hover:opacity-75 transition duration-300 flex-shrink-0"
                            onclick="changeMainImage(this.src)" />
                        <img src="/placeholder.svg?height=80&width=120&text=Interior" alt="Interior"
                            class="w-20 h-16 rounded cursor-pointer hover:opacity-75 transition duration-300 flex-shrink-0"
                            onclick="changeMainImage(this.src)" />
                        <img src="/placeholder.svg?height=80&width=120&text=Dashboard" alt="Dashboard"
                            class="w-20 h-16 rounded cursor-pointer hover:opacity-75 transition duration-300 flex-shrink-0"
                            onclick="changeMainImage(this.src)" />
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
                                <span class="font-medium text-navy">2023</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Warna:</span>
                                <span class="font-medium text-navy">Putih</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kapasitas Penumpang:</span>
                                <span class="font-medium text-navy">7 Orang</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Transmisi:</span>
                                <span class="font-medium text-navy">Manual</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Bahan Bakar:</span>
                                <span class="font-medium text-navy">Bensin</span>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pendingin Udara:</span>
                                <span class="font-medium text-navy">AC</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tipe Mesin:</span>
                                <span class="font-medium text-navy">1.3L DOHC VVT-i</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tenaga Maksimal:</span>
                                <span class="font-medium text-navy">96 PS / 6,000 rpm</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Torsi Maksimal:</span>
                                <span class="font-medium text-navy">121 Nm / 4,400 rpm</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Konsumsi BBM:</span>
                                <span class="font-medium text-navy">13-15 km/liter</span>
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
                                4190
                            </div>
                            <div class="text-gray-500 text-sm">
                                Panjang (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                1660
                            </div>
                            <div class="text-gray-500 text-sm">
                                Lebar (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                1695
                            </div>
                            <div class="text-gray-500 text-sm">
                                Tinggi (mm)
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-navy">
                                45
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
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">AC Double Blower</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Audio System USB</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Power Steering</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Central Lock</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Electric Mirror</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Dual SRS Airbag</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">ABS + EBD</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Sabuk Pengaman 3-Titik</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span class="text-gray-700">Immobilizer</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h4 class="text-lg font-semibold text-navy">
                        Fasilitas Elite Rental
                    </h4>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-center">
                            <i class="fas fa-gas-pump text-gold mr-2"></i>
                            <span class="text-gray-700">BBM Penuh</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-tools text-gold mr-2"></i>
                            <span class="text-gray-700">Toolkit Lengkap</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-headset text-gold mr-2"></i>
                            <span class="text-gray-700">Support 24/7</span>
                        </div>
                    </div>
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
                        Toyota Avanza adalah kendaraan pilihan yang
                        sempurna untuk keluarga dan perjalanan
                        bisnis. Dengan desain yang elegan dan fitur
                        keselamatan terdepan, Avanza menawarkan
                        kenyamanan maksimal untuk perjalanan Anda.
                        Kendaraan ini dilengkapi dengan AC double
                        blower, audio system dengan USB, dan
                        berbagai fitur keselamatan seperti dual SRS
                        airbag dan ABS + EBD.
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
                                Rp 300.000
                            </div>
                            <div class="text-sm text-gray-500 line-through">
                                Rp 350.000
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Per Minggu:</span>
                        <div class="text-xl font-bold text-navy">
                            Rp 1.800.000
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Per Bulan:</span>
                        <div class="text-xl font-bold text-navy">
                            Rp 6.500.000
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
                            <li>• Usia minimal 21 tahun</li>
                            <li>
                                • Memiliki SIM A yang masih berlaku
                            </li>
                            <li>• Menyerahkan KTP asli</li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Ketentuan Sewa:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li>• Sewa minimal 24 jam</li>
                            <li>• Overtime Rp 25.000/jam</li>
                            <li>• Deposit Rp 500.000</li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="font-semibold text-navy mb-2">
                            Larangan:
                        </h5>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li>• Dilarang merokok</li>
                            <li>• Dilarang membawa hewan</li>
                            <li>
                                • Dilarang melanggar aturan lalu
                                lintas
                            </li>
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
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                        </div>
                        <div class="text-lg font-semibold text-green-600 mb-2">
                            Tersedia
                        </div>
                        <div class="text-sm text-gray-500">
                            Siap untuk disewa
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- JavaScript spesifik halaman detail kendaraan --}}
    <script>
        // Image gallery functionality (disimpan di sini karena spesifik detail kendaraan)
        function changeMainImage(src) {
            document.getElementById("mainImage").src = src;
        }
    </script>
@endpush

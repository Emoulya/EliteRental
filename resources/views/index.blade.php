<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Elite Rental - Solusi Rental Berkualitas</title>
</head>

<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-navy shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Left: Logo -->
                <div class="flex items-center flex-shrink-0">
                    <h1 class="text-2xl font-bold text-gold">Elite Rental</h1>
                </div>
                <!-- Center: Nav Links -->
                <div class="hidden md:flex flex-1 justify-center">
                    <div class="flex space-x-8">
                        <a href="#beranda" class="text-white hover:text-gold transition duration-300">Beranda</a>
                        <a href="#tentang" class="text-white hover:text-gold transition duration-300">Tentang</a>
                        <a href="#layanan" class="text-white hover:text-gold transition duration-300">Layanan</a>
                        <a href="#kendaraan" class="text-white hover:text-gold transition duration-300">Kendaraan</a>
                        <a href="#kontak" class="text-white hover:text-gold transition duration-300">Kontak</a>
                    </div>
                </div>
                <!-- Right: User Dropdown or Login -->
                <div class="flex items-center">
                    @auth
                        <div class="relative group">
                            <button class="flex items-center text-white font-semibold focus:outline-none">
                                {{ Auth::user()->name }}
                                <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div
                                class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg py-2 z-50 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto transition-opacity duration-200">
                                <a href="#"
                                    class="block px-4 py-2 text-navy hover:bg-gold hover:text-white">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-navy hover:bg-gold hover:text-white">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-gold text-navy font-bold px-5 py-2 rounded-lg hover:bg-yellow-500 transition duration-300">Login</a>
                    @endauth
                    <!-- Mobile menu button -->
                    <div class="md:hidden ml-4">
                        <button class="text-white hover:text-gold">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative bg-gradient-to-r from-navy to-gray-800 min-h-screen flex items-center">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('/placeholder.svg?height=800&width=1200&text=Luxury+Car+Background')">
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-slide-up">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Selamat Datang di <span class="text-gold">Elite Rental</span>
            </h1>
            <h2 class="text-xl md:text-2xl text-white mb-8">
                Solusi Terbaik Rental Kendaraan Anda!
            </h2>
            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-3xl mx-auto">
                Menyediakan kendaraan berkualitas dengan harga terjangkau dan layanan ramah, untuk setiap kebutuhan
                perjalanan Anda.
            </p>
            <div class="space-x-4">
                <button
                    class="bg-gold hover:bg-yellow-500 text-navy font-bold py-4 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105">
                    Sewa Sekarang
                </button>
                <button
                    class="border-2 border-gold text-gold hover:bg-gold hover:text-navy font-bold py-4 px-8 rounded-lg text-lg transition duration-300">
                    Lihat Kendaraan
                </button>
            </div>
        </div>
    </section>

    <!-- Tentang Kami -->
    <section id="tentang" class="py-20 bg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-navy mb-4">Tentang Kami</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center animate-slide-up">
                <div>
                    <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Tentang Kami" class="rounded-lg shadow-xl">
                </div>
                <div>
                    <p class="text-lg text-gray-custom mb-6 leading-relaxed">
                        Elite Rental adalah layanan rental kendaraan terpercaya yang telah beroperasi sejak 2015. Kami
                        menyediakan berbagai jenis kendaraan untuk kebutuhan pribadi, bisnis, maupun perjalanan wisata.
                    </p>
                    <p class="text-lg text-gray-custom mb-8 leading-relaxed">
                        Dengan pelayanan yang profesional dan armada yang selalu terawat, kami berkomitmen menjadi mitra
                        perjalanan terbaik Anda.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gold mb-2">500+</div>
                            <div class="text-gray-custom">Kendaraan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gold mb-2">10K+</div>
                            <div class="text-gray-custom">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-navy mb-4">Visi & Misi Kami</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 animate-slide-up">
                <div class="bg-light-gray p-8 rounded-lg shadow-lg">
                    <div class="text-center mb-6">
                        <i class="fas fa-eye text-4xl text-gold mb-4"></i>
                        <h3 class="text-2xl font-bold text-navy">Visi</h3>
                    </div>
                    <p class="text-gray-custom text-center leading-relaxed">
                        Menjadi perusahaan rental kendaraan terdepan yang mengutamakan kenyamanan, keselamatan, dan
                        kepuasan pelanggan.
                    </p>
                </div>
                <div class="bg-light-gray p-8 rounded-lg shadow-lg">
                    <div class="text-center mb-6">
                        <i class="fas fa-bullseye text-4xl text-gold mb-4"></i>
                        <h3 class="text-2xl font-bold text-navy">Misi</h3>
                    </div>
                    <ul class="text-gray-custom space-y-3">
                        <li class="flex items-start">
                            <i class="fas fa-check text-gold mr-3 mt-1"></i>
                            Menyediakan kendaraan yang bersih, aman, dan terawat
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-gold mr-3 mt-1"></i>
                            Memberikan pelayanan yang ramah, cepat, dan profesional
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-gold mr-3 mt-1"></i>
                            Menawarkan harga sewa yang kompetitif dan transparan
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-gold mr-3 mt-1"></i>
                            Meningkatkan kualitas layanan secara berkelanjutan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Kami -->
    <section id="layanan" class="py-20 bg-navy">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-white mb-4">Pelayanan Terbaik Kami</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-3 lg:grid-cols-5 gap-8 animate-slide-up">
                <div class="text-center">
                    <div class="bg-gold w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-navy"></i>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Proses Cepat</h3>
                    <p class="text-gray-300 text-sm">Pemesanan cepat dan mudah</p>
                </div>
                <div class="text-center">
                    <div class="bg-gold w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-car text-2xl text-navy"></i>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Armada Lengkap</h3>
                    <p class="text-gray-300 text-sm">Kendaraan selalu terawat</p>
                </div>
                <div class="text-center">
                    <div class="bg-gold w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar text-2xl text-navy"></i>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Rental Fleksibel</h3>
                    <p class="text-gray-300 text-sm">Harian, mingguan, bulanan</p>
                </div>
                <div class="text-center">
                    <div class="bg-gold w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-2xl text-navy"></i>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Support 24/7</h3>
                    <p class="text-gray-300 text-sm">Layanan pelanggan responsif</p>
                </div>
                <div class="text-center">
                    <div class="bg-gold w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-navy"></i>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Jaminan Aman</h3>
                    <p class="text-gray-300 text-sm">Keamanan dan kenyamanan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Jenis Kendaraan -->
    <section id="kendaraan" class="py-20 bg-light-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-navy mb-4">Kendaraan yang Tersedia</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 animate-slide-up">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="/placeholder.svg?height=200&width=300&text=Mobil+Keluarga" alt="Mobil Keluarga"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-navy mb-2">Mobil Keluarga</h3>
                        <p class="text-gray-custom mb-4">Avanza, Xenia, Ertiga, dll</p>
                        <div class="text-gold font-bold text-lg">Mulai Rp 300K/hari</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="/placeholder.svg?height=200&width=300&text=Mobil+Mewah" alt="Mobil Mewah"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-navy mb-2">Mobil Mewah</h3>
                        <p class="text-gray-custom mb-4">Fortuner, Pajero, Alphard</p>
                        <div class="text-gold font-bold text-lg">Mulai Rp 800K/hari</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="/placeholder.svg?height=200&width=300&text=Motor" alt="Motor"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-navy mb-2">Motor</h3>
                        <p class="text-gray-custom mb-4">Scoopy, Vario, NMax, dll</p>
                        <div class="text-gold font-bold text-lg">Mulai Rp 75K/hari</div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                    <img src="/placeholder.svg?height=200&width=300&text=Pick+Up" alt="Pick Up"
                        class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-navy mb-2">Pick Up / Barang</h3>
                        <p class="text-gray-custom mb-4">L300, Colt Diesel, dll</p>
                        <div class="text-gold font-bold text-lg">Mulai Rp 400K/hari</div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="{{ url('/daftar-kendaraan') }}">
                    <button
                        class="bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-8 rounded-lg text-lg transition duration-300 transform hover:scale-105">
                        Lihat Semua Kendaraan
                    </button>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-navy mb-4">Testimoni Pelanggan</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-light-gray p-6 rounded-lg shadow-lg">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                    </div>
                    <p class="text-gray-custom mb-4 italic">"Pelayanan sangat memuaskan! Mobil bersih dan terawat.
                        Proses rental juga cepat dan mudah. Pasti akan sewa lagi di Elite Rental."</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50&text=User1" alt="Customer"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-navy">Budi Santoso</h4>
                            <p class="text-sm text-gray-custom">Jakarta</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light-gray p-6 rounded-lg shadow-lg">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                    </div>
                    <p class="text-gray-custom mb-4 italic">"Harga kompetitif dengan kualitas terbaik. Staff ramah dan
                        profesional. Recommended banget untuk yang butuh rental kendaraan!"</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50&text=User2" alt="Customer"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-navy">Sari Dewi</h4>
                            <p class="text-sm text-gray-custom">Bandung</p>
                        </div>
                    </div>
                </div>
                <div class="bg-light-gray p-6 rounded-lg shadow-lg">
                    <div class="flex mb-4">
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                        <i class="fas fa-star text-gold"></i>
                    </div>
                    <p class="text-gray-custom mb-4 italic">"Sudah beberapa kali sewa di Elite Rental untuk keperluan
                        bisnis. Selalu puas dengan pelayanan dan kondisi kendaraannya."</p>
                    <div class="flex items-center">
                        <img src="/placeholder.svg?height=50&width=50&text=User3" alt="Customer"
                            class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-navy">Ahmad Rizki</h4>
                            <p class="text-sm text-gray-custom">Surabaya</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section id="kontak" class="py-20 bg-navy">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-white mb-4">Hubungi Kami</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12">
                <div class="animate-slide-up">
                    <h3 class="text-2xl font-bold text-white mb-6">Informasi Kontak</h3>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-gold text-xl mr-4"></i>
                            <div class="text-white">
                                <p>Jl. Sudirman No. 123, Jakarta Pusat</p>
                                <p>DKI Jakarta 10220</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-gold text-xl mr-4"></i>
                            <div class="text-white">
                                <p>+62 21 1234 5678</p>
                                <p>+62 812 3456 7890</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-gold text-xl mr-4"></i>
                            <div class="text-white">
                                <p>info@eliterental.com</p>
                                <p>booking@eliterental.com</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock text-gold text-xl mr-4"></i>
                            <div class="text-white">
                                <p>Senin - Minggu: 24 Jam</p>
                                <p>Layanan Darurat Tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="animate-slide-up">
                    <h3 class="text-2xl font-bold text-white mb-6">Kirim Pesan</h3>
                    <form class="space-y-4">
                        <div>
                            <input type="text" placeholder="Nama Lengkap"
                                class="w-full px-4 py-3 rounded-lg bg-white text-navy focus:outline-none focus:ring-2 focus:ring-gold">
                        </div>
                        <div>
                            <input type="email" placeholder="Email"
                                class="w-full px-4 py-3 rounded-lg bg-white text-navy focus:outline-none focus:ring-2 focus:ring-gold">
                        </div>
                        <div>
                            <input type="tel" placeholder="No. Telepon"
                                class="w-full px-4 py-3 rounded-lg bg-white text-navy focus:outline-none focus:ring-2 focus:ring-gold">
                        </div>
                        <div>
                            <textarea rows="4" placeholder="Pesan Anda"
                                class="w-full px-4 py-3 rounded-lg bg-white text-navy focus:outline-none focus:ring-2 focus:ring-gold"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-gold hover:bg-yellow-500 text-navy font-bold py-3 px-6 rounded-lg transition duration-300">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-gold mb-4">Elite Rental</h3>
                    <p class="text-gray-300 mb-4">Solusi terbaik untuk kebutuhan rental kendaraan Anda dengan pelayanan
                        profesional dan armada berkualitas.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gold hover:text-white transition duration-300">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gold hover:text-white transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gold hover:text-white transition duration-300">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                        <a href="#" class="text-gold hover:text-white transition duration-300">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-gold transition duration-300">Rental Mobil</a></li>
                        <li><a href="#" class="hover:text-gold transition duration-300">Rental Motor</a></li>
                        <li><a href="#" class="hover:text-gold transition duration-300">Rental Pick Up</a></li>
                        <li><a href="#" class="hover:text-gold transition duration-300">Paket Wisata</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Informasi</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#tentang" class="hover:text-gold transition duration-300">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-gold transition duration-300">Syarat & Ketentuan</a>
                        </li>
                        <li><a href="#" class="hover:text-gold transition duration-300">Kebijakan Privasi</a>
                        </li>
                        <li><a href="#" class="hover:text-gold transition duration-300">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak Cepat</h4>
                    <div class="space-y-2 text-gray-300">
                        <p><i class="fas fa-phone text-gold mr-2"></i> +62 21 1234 5678</p>
                        <p><i class="fas fa-envelope text-gold mr-2"></i> info@eliterental.com</p>
                        <p><i class="fas fa-map-marker-alt text-gold mr-2"></i> Jakarta, Indonesia</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">&copy; 2024 Elite Rental. Semua hak dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop"
        class="fixed bottom-6 right-6 bg-gold text-navy p-3 rounded-full opacity-0 shadow-lg transition-all duration-300  hover:bg-yellow-500 hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.style.opacity = '1';
                scrollTopBtn.style.transform = 'translateY(0)';
            } else {
                scrollTopBtn.style.opacity = '0';
                scrollTopBtn.style.transform = 'translateY(10px)';
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-slide-up').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.8s ease-out';
            observer.observe(el);
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.md\\:hidden button');
        const mobileMenu = document.createElement('div');
        mobileMenu.className = 'md:hidden bg-navy';
        mobileMenu.innerHTML = `
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="#beranda" class="block px-3 py-2 text-white hover:text-gold">Beranda</a>
                <a href="#tentang" class="block px-3 py-2 text-white hover:text-gold">Tentang</a>
                <a href="#layanan" class="block px-3 py-2 text-white hover:text-gold">Layanan</a>
                <a href="#kendaraan" class="block px-3 py-2 text-white hover:text-gold">Kendaraan</a>
                <a href="#kontak" class="block px-3 py-2 text-white hover:text-gold">Kontak</a>
            </div>
        `;
        mobileMenu.style.display = 'none';
        document.querySelector('nav').appendChild(mobileMenu);

        mobileMenuBtn.addEventListener('click', () => {
            if (mobileMenu.style.display === 'none') {
                mobileMenu.style.display = 'block';
            } else {
                mobileMenu.style.display = 'none';
            }
        });
    </script>
</body>

</html>

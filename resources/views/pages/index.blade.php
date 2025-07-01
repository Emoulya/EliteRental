@extends('layouts.app')

@section('content')
    @include('components.hero')

    <section id="tentang" class="py-20 bg-navy">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-white mb-4">Tentang Kami</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>
            <div class="grid md:grid-cols-2 gap-12 items-center animate-slide-up">
                <div>
                    <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Tentang Kami" class="rounded-lg shadow-xl">
                </div>
                <div>
                    <p class="text-lg text-white mb-6 leading-relaxed">
                        Elite Rental adalah layanan rental kendaraan terpercaya yang telah beroperasi sejak 2015. Kami
                        menyediakan berbagai jenis kendaraan untuk kebutuhan pribadi, bisnis, maupun perjalanan wisata.
                    </p>
                    <p class="text-lg text-white mb-8 leading-relaxed">
                        Dengan pelayanan yang profesional dan armada yang selalu terawat, kami berkomitmen menjadi mitra
                        perjalanan terbaik Anda.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gold mb-2">500+</div>
                            <div class="text-white">Kendaraan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gold mb-2">10K+</div>
                            <div class="text-white">Pelanggan Puas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                <a href="#">
                    <x-buttons.primary-button class="py-4 px-8 text-lg hover:scale-105">
                        Lihat semua Kendaraan
                    </x-buttons.primary-button>
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-slide-up">
                <h2 class="text-4xl font-bold text-navy mb-4">Testimoni Pelanggan</h2>
                <div class="w-24 h-1 bg-gold mx-auto"></div>
            </div>

            <div class="carousel-container overflow-hidden relative py-3">
                <div class="flex animate-scroll">
                    <!-- Set pertama testimoni -->
                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pelayanan sangat memuaskan! Mobil bersih dan terawat. Proses rental juga cepat dan
                                    mudah. Pasti akan sewa lagi di Elite Rental."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">BS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Budi Santoso</h4>
                                    <p class="text-sm text-gray-custom">Jakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Harga kompetitif dengan kualitas terbaik. Staff ramah dan profesional. Recommended
                                    banget untuk yang butuh rental kendaraan!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">SD</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Sari Dewi</h4>
                                    <p class="text-sm text-gray-custom">Bandung</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sudah beberapa kali sewa di Elite Rental untuk keperluan bisnis. Selalu puas dengan
                                    pelayanan dan kondisi kendaraannya."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">AR</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Ahmad Rizki</h4>
                                    <p class="text-sm text-gray-custom">Surabaya</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Motor yang disewa kondisinya prima dan irit bensin. Cocok banget untuk keliling kota.
                                    Terima kasih Elite Rental!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">DA</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Dina Anggraini</h4>
                                    <p class="text-sm text-gray-custom">Yogyakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pelayanan 24 jam sangat membantu. Pernah butuh mobil mendadak tengah malam, langsung
                                    diproses. Top service!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">RF</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Rendi Firmansyah</h4>
                                    <p class="text-sm text-gray-custom">Medan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sewa Alphard untuk acara keluarga, kondisi interior sangat bersih dan nyaman. Supir
                                    juga sopan dan berpengalaman."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">LK</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Lisa Kartika</h4>
                                    <p class="text-sm text-gray-custom">Semarang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pick up yang disewa untuk pindahan sangat membantu. Kondisi mesin bagus dan daya angkut
                                    sesuai kebutuhan."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">HS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Hendra Saputra</h4>
                                    <p class="text-sm text-gray-custom">Makassar</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Booking online sangat mudah dan cepat. Tim customer service responsif banget.
                                    Pengalaman rental terbaik yang pernah saya alami!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">NW</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Nina Wijaya</h4>
                                    <p class="text-sm text-gray-custom">Palembang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sudah langganan Elite Rental selama 3 tahun. Tidak pernah kecewa dengan pelayanan dan
                                    kualitas kendaraannya. Highly recommended!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">IP</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Indra Pratama</h4>
                                    <p class="text-sm text-gray-custom">Denpasar</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DUPLIKAT SET TESTIMONI UNTUK LOOPING MULUS -->
                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pelayanan sangat memuaskan! Mobil bersih dan terawat. Proses rental juga cepat dan
                                    mudah. Pasti akan sewa lagi di Elite Rental."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">BS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Budi Santoso</h4>
                                    <p class="text-sm text-gray-custom">Jakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Harga kompetitif dengan kualitas terbaik. Staff ramah dan profesional. Recommended
                                    banget untuk yang butuh rental kendaraan!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">SD</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Sari Dewi</h4>
                                    <p class="text-sm text-gray-custom">Bandung</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sudah beberapa kali sewa di Elite Rental untuk keperluan bisnis. Selalu puas dengan
                                    pelayanan dan kondisi kendaraannya."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">AR</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Ahmad Rizki</h4>
                                    <p class="text-sm text-gray-custom">Surabaya</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Motor yang disewa kondisinya prima dan irit bensin. Cocok banget untuk keliling kota.
                                    Terima kasih Elite Rental!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">DA</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Dina Anggraini</h4>
                                    <p class="text-sm text-gray-custom">Yogyakarta</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pelayanan 24 jam sangat membantu. Pernah butuh mobil mendadak tengah malam, langsung
                                    diproses. Top service!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">RF</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Rendi Firmansyah</h4>
                                    <p class="text-sm text-gray-custom">Medan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sewa Alphard untuk acara keluarga, kondisi interior sangat bersih dan nyaman. Supir
                                    juga sopan dan berpengalaman."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">LK</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Lisa Kartika</h4>
                                    <p class="text-sm text-gray-custom">Semarang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Pick up yang disewa untuk pindahan sangat membantu. Kondisi mesin bagus dan daya angkut
                                    sesuai kebutuhan."
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">HS</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Hendra Saputra</h4>
                                    <p class="text-sm text-gray-custom">Makassar</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Booking online sangat mudah dan cepat. Tim customer service responsif banget.
                                    Pengalaman rental terbaik yang pernah saya alami!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">NW</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Nina Wijaya</h4>
                                    <p class="text-sm text-gray-custom">Palembang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-shrink-0 w-80 mx-4">
                        <div class="bg-light-gray p-6 rounded-lg shadow-lg h-full flex flex-col justify-between">
                            <div>
                                <div class="flex mb-4">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                                <p class="text-gray-custom mb-4 italic">
                                    "Sudah langganan Elite Rental selama 3 tahun. Tidak pernah kecewa dengan pelayanan dan
                                    kualitas kendaraannya. Highly recommended!"
                                </p>
                            </div>
                            <div class="flex items-center mt-auto">
                                <div class="w-12 h-12 rounded-full bg-navy flex items-center justify-center mr-4">
                                    <span class="text-white font-bold">IP</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-navy">Indra Pratama</h4>
                                    <p class="text-sm text-gray-custom">Denpasar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
@endsection

{{-- resources/views/components/navigation/navbar.blade.php --}}
<nav class="bg-navy shadow-lg fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center flex-shrink-0">
                <h1 class="text-2xl font-bold text-gold">Elite Rental</h1>
            </div>
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex space-x-8">
                    <a href="#beranda" class="text-white hover:text-gold transition duration-300">Beranda</a>
                    <a href="#tentang" class="text-white hover:text-gold transition duration-300">Tentang</a>
                    <a href="#layanan" class="text-white hover:text-gold transition duration-300">Layanan</a>
                    <a href="#kendaraan" class="text-white hover:text-gold transition duration-300">Kendaraan</a>
                    <a href="#kontak" class="text-white hover:text-gold transition duration-300">Kontak</a>
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    {{-- Panggil komponen user-dropdown yang baru --}}
                    <x-navigation.user-dropdown />
                @else
                    <a href="{{ route('login') }}">
                        <x-buttons.primary-button>Login</x-buttons.primary-button>
                    </a>
                @endauth
                <div class="md:hidden ml-4">
                    <button class="text-white hover:text-gold">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

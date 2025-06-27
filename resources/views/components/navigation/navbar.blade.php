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
                            <a href="#" class="block px-4 py-2 text-navy hover:bg-gold hover:text-white">Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-navy hover:bg-gold hover:text-white">Logout</button>
                            </form>
                        </div>
                    </div>
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

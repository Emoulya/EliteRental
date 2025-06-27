{{-- resources/views/components/admin-header.blade.php --}}
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-6 py-4">
        <div class="flex items-center">
            <button id="sidebarToggle" class="text-gray-500 hover:text-gray-600 lg:hidden">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div class="ml-4">
                {{-- Judul halaman dinamis --}}
                <h2 class="text-2xl font-semibold text-navy">
                    @yield('page_title', 'Dashboard')
                </h2>
                <p class="text-sm text-gray-500">
                    Selamat datang kembali, {{ Auth::user()->name ?? 'Admin' }}!
                </p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Quick Actions -->
            {{-- Menggunakan komponen primary-button Anda --}}
            <a href="{{ route('admin.bookings.create') }}"> {{-- Asumsi ada route untuk membuat booking --}}
                <x-buttons.primary-button>
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Booking
                </x-buttons.primary-button>
            </a>

            <!-- Notifications -->
            <div class="relative">
                <button class="flex items-center text-gray-500 hover:text-gray-600">
                    <i class="fas fa-bell text-xl"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-gold text-navy text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                </button>
            </div>

            <!-- User Profile Dropdown -->
            <div class="relative inline-flex items-center group">
                <img src="https://placehold.co/40x40/{{ str_replace('#', '', config('app.colors.navy', '0A1F33')) }}/{{ str_replace('#', '', config('app.colors.gold', 'F4B000')) }}?text={{ substr(Auth::user()->name ?? 'A', 0, 1) }}"
                    alt="Admin" class="w-10 h-10 rounded-full cursor-pointer" />
                {{-- Dropdown untuk profil --}}
                <div
                    class="absolute right-0 mt-20 w-40 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 group-hover:opacity-100 group-focus-within:opacity-100 pointer-events-none group-hover:pointer-events-auto group-focus-within:pointer-events-auto transition-opacity duration-200">
                    <a href="#"
                        class="block px-4 py-2 text-sm text-navy hover:bg-gold hover:text-white">Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-navy hover:bg-gold hover:text-white">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

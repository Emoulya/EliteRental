{{-- resources/views/components/admin-header.blade.php --}}
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="flex items-center justify-between px-6 h-20">
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
            <a href="{{ route('admin.bookings.create') }}">
                <x-buttons.primary-button>
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Booking
                </x-buttons.primary-button>
            </a>

            <div class="relative">
                <button class="flex items-center text-gray-500 hover:text-gray-600">
                    <i class="fas fa-bell text-xl"></i>
                    <span
                        class="absolute -top-1 -right-1 bg-gold text-navy text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                </button>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    {{-- Trigger ini yang akan diklik untuk membuka dropdown --}}
                    {{-- Pastikan ini adalah sebuah <button> atau <a> yang bisa menerima event click --}}
                    <button
                        class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                        <img src="https://placehold.co/40x40/{{ str_replace('#', '', config('app.colors.navy', '0A1F33')) }}/{{ str_replace('#', '', config('app.colors.gold', 'F4B000')) }}?text={{ substr(Auth::user()->name ?? 'A', 0, 1) }}"
                            alt="{{ Auth::user()->name ?? 'Admin' }}" class="w-10 h-10 rounded-full cursor-pointer" />
                        {{-- Opsional: Tambahkan nama pengguna jika Anda ingin teks di samping gambar --}}
                        <div class="hidden md:block ml-2 text-navy"> {{-- Tambahkan text-navy jika ingin sesuai tema --}}
                            {{ Auth::user()->name ?? 'Admin' }}
                        </div>
                        <div class="ms-1 hidden md:block"> {{-- Sembunyikan SVG di mobile jika tidak perlu --}}
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    {{-- Isi dropdown link di sini --}}
                    {{-- Sesuaikan warna dropdown link dan hovernya --}}
                    <x-dropdown-link :href="route('profile.edit')" class="text-navy hover:bg-gold hover:text-white">
                        {{-- Menambahkan kelas override --}}
                        {{ __('Profil') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-navy hover:bg-gold hover:text-white"> {{-- Menambahkan kelas override --}}
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</header>

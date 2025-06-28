{{-- resources/views/components/navigation/admin-sidebar.blade.php --}}
<div id="sidebar"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-navy transform -translate-x-full transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:flex-shrink-0">
    <div class="flex items-center justify-center h-20 shadow-md">
        <h1 class="text-2xl font-bold text-gold">Elite Rental</h1>
    </div>

    <nav class="mt-10">
        <div class="px-4 space-y-2">
            {{-- Item Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.dashboard')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>

            {{-- Item Kendaraan --}}
            <a href="{{ route('admin.vehicles') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.vehicles')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-car mr-3"></i>
                Kendaraan
            </a>

            {{-- Item Booking --}}
            <a href="{{ route('admin.bookings') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.bookings')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-calendar-check mr-3"></i>
                Booking
            </a>

            {{-- Item Pelanggan --}}
            <a href="{{ route('admin.customers') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.customers')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-users mr-3"></i>
                Pelanggan
            </a>

            {{-- Item Keuangan --}}
            <a href="{{ route('admin.finance') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.finance')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-money-bill-wave mr-3"></i>
                Keuangan
            </a>

            {{-- Item Laporan --}}
            <a href="{{ route('admin.reports') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.reports')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-chart-bar mr-3"></i>
                Laporan
            </a>

            {{-- Item Pengaturan --}}
            <a href="{{ route('admin.settings') }}"
                class="flex items-center px-4 py-3 rounded-lg transition duration-300
            @if (request()->routeIs('admin.settings')) bg-gold
            @else text-gray-300 hover:bg-gray-700 hover:text-white @endif">
                <i class="fas fa-cog mr-3"></i>
                Pengaturan
            </a>
        </div>
    </nav>

    <div class="absolute bottom-0 w-full p-4">
        {{-- Menggunakan form untuk logout agar Laravel mengurus CSRF token --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-gray-700 hover:text-white transition duration-300 w-full text-left">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </button>
        </form>
    </div>
</div>

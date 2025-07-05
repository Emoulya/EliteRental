{{-- resources/views/components/public/vehicle-filter.blade.php --}}
<form id="publicVehicleFilterForm" method="GET" action="{{ route('vehicles.index') }}">
    <div class="grid md:grid-cols-4 gap-4 mb-6">
        <div class="relative">
            <input type="text" id="searchInput" name="search" placeholder="Cari kendaraan..."
                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold"
                value="{{ request('search') }}" />
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>

        <x-forms.select-input id="categoryFilter" name="category_filter">
            <option value="">Semua Kategori</option>
            <option value="mobil-keluarga" @selected(request('category_filter') == 'mobil-keluarga')>Mobil Keluarga</option>
            <option value="mobil-mewah" @selected(request('category_filter') == 'mobil-mewah')>Mobil Mewah</option>
            <option value="motor" @selected(request('category_filter') == 'motor')>Motor</option>
            <option value="pickup" @selected(request('category_filter') == 'pickup')>Pick Up</option>
        </x-forms.select-input>

        <x-forms.select-input id="priceFilter" name="price_filter">
            <option value="">Semua Harga</option>
            <option value="0-200000" @selected(request('price_filter') == '0-200000')>&lt; Rp 200K</option>
            <option value="200000-500000" @selected(request('price_filter') == '200000-500000')>Rp 200K - 500K</option>
            <option value="500000-1000000" @selected(request('price_filter') == '500000-1000000')>Rp 500K - 1Jt</option>
            <option value="1000000-999999999" @selected(request('price_filter') == '1000000-999999999')>&gt; Rp 1Jt</option>
        </x-forms.select-input>

        <x-forms.select-input id="availabilityFilter" name="availability_filter">
            <option value="">Semua Status</option>
            <option value="available" @selected(request('availability_filter') == 'available')>Tersedia</option>
            <option value="disewa" @selected(request('availability_filter') == 'disewa')>Disewa</option>
            <option value="maintenance" @selected(request('availability_filter') == 'maintenance')>Maintenance</option>
            <option value="unavailable" @selected(request('availability_filter') == 'unavailable')>Tidak Tersedia</option>
        </x-forms.select-input>
    </div>
    <div class="flex justify-end">
        <x-buttons.secondary-button type="button" id="resetFilters">
            <i class="fas fa-undo mr-2"></i>
            Reset Filter
        </x-buttons.secondary-button>
    </div>
</form>

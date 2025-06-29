{{-- resources\views\components\vehicles\filter-section.blade.php --}}
<div class="px-6 py-4 bg-light-gray border-b border-gray-200">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari kendaraan..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-gold focus:border-gold" />
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        </div>

        <x-forms.select-input id="categoryFilter" name="category_filter">
            <option value="">Semua Kategori</option>
            <option value="mobil-keluarga">Mobil Keluarga</option>
            <option value="mobil-mewah">Mobil Mewah</option>
            <option value="motor">Motor</option>
            <option value="pickup">Pick Up</option>
        </x-forms.select-input>

        <x-forms.select-input id="statusFilter" name="status_filter">
            <option value="">Semua Status</option>
            <option value="available">Tersedia</option>
            <option value="rented">Disewa</option>
            <option value="maintenance">Maintenance</option>
        </x-forms.select-input>

        <x-buttons.secondary-button id="resetFilters">
            <i class="fas fa-undo mr-2"></i>
            Reset
        </x-buttons.secondary-button>
    </div>
</div>

{{-- resources\views\components\vehicles\management-header.blade.php --}}
@props(['title'])

<div class="px-6 py-4 border-b border-gray-200">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <h3 class="text-lg font-medium text-navy">
            {{ $title }}
        </h3>
        <div class="mt-4 sm:mt-0 flex space-x-3">
            <button id="addVehicleBtn"
                class="bg-gold hover:bg-yellow-500 text-navy font-semibold py-2 px-4 rounded-lg transition duration-300">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kendaraan
            </button>
            <x-buttons.secondary-button>
                <i class="fas fa-download mr-2"></i>
                Export
            </x-buttons.secondary-button>
        </div>
    </div>
</div>

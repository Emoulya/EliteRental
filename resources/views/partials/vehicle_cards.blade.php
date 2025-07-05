{{-- resources/views/partials/vehicle_cards.blade.php --}}
@forelse($vehicles as $vehicle)
    <x-vehicle-card :vehicle="$vehicle" />
@empty
    <p class="col-span-full text-center text-gray-custom text-lg">Tidak ada kendaraan yang tersedia saat ini.</p>
@endforelse

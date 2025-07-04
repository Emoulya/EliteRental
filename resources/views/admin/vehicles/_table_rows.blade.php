{{-- resources/views/admin/vehicles/_table_rows.blade.php --}}
{{-- File ini diharapkan menerima variabel $vehicles --}}

@forelse($vehicles as $vehicle)
    <tr class="hover:bg-gray-50" id="vehicle-row-{{ $vehicle->id }}" data-category="{{ $vehicle->category }}"
        data-status="{{ $vehicle->status }}">
        <td class="px-6 py-4 whitespace-nowrap">
            <input type="checkbox" class="rounded border-gray-300 text-gold focus:ring-gold" />
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <div class="flex items-center">
                <img src="{{ $vehicle->main_image ? asset('storage/' . $vehicle->main_image) : '/placeholder.svg?height=60&width=80&text=' . $vehicle->model }}"
                    alt="{{ $vehicle->brand }} {{ $vehicle->model }}" class="w-16 h-12 rounded-lg object-cover" />
                <div class="ml-4">
                    <div class="text-sm font-medium text-navy">{{ $vehicle->brand }} {{ $vehicle->model }}</div>
                    <div class="text-sm text-gray-custom">{{ $vehicle->license_plate }}</div>
                </div>
            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                {{ ucwords(str_replace('-', ' ', $vehicle->category)) }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-navy font-semibold">
            Rp {{ number_format($vehicle->daily_price, 0, ',', '.') }}
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
            @php
                $statusColor =
                    [
                        'tersedia' => 'green',
                        'disewa' => 'red',
                        'maintenance' => 'yellow',
                        'unavailable' => 'gray',
                    ][$vehicle->status] ?? 'gray';
            @endphp
            <span
                class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                {{ ucfirst($vehicle->status) }}
            </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
            <div class="flex space-x-2">
                {{-- Icon Mata (Lihat Detail) --}}
                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}" class="text-blue-600 hover:text-blue-900"
                    title="Lihat Detail">
                    <i class="fas fa-eye"></i>
                </a>

                {{-- Tombol Edit mengarah ke halaman baru --}}
                <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}?_referrer=vehicles"
                    class="text-green-600 hover:text-green-900" title="Edit">
                    <i class="fas fa-edit"></i>
                </a>

                {{-- Form Hapus (tetap sama) --}}
                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Tidak ada kendaraan ditemukan.
        </td>
    </tr>
@endforelse

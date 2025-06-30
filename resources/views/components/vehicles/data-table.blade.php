{{-- resources\views\components\vehicles\data-table.blade.php --}}
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-light-gray"> {{-- Menggunakan light-gray --}}
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-gold focus:ring-gold" />
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Kendaraan
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Kategori
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Harga/Hari
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody id="vehicleTableBody" class="bg-white divide-y divide-gray-200">
            {{ $slot }} {{-- Ini akan merender baris data kendaraan --}}
        </tbody>
    </table>
</div>

{{-- Contoh baris data (bisa dipisah menjadi komponen lain jika sangat kompleks) --}}
{{-- Anda akan mengisi ini dari controller atau loop data --}}
{{--
<tr class="hover:bg-gray-50">
    <td class="px-6 py-4 whitespace-nowrap">
        <input type="checkbox" class="rounded border-gray-300 text-gold focus:ring-gold" />
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <img src="/placeholder.svg?height=60&width=80&text=Avanza" alt="Toyota Avanza" class="w-16 h-12 rounded-lg object-cover" />
            <div class="ml-4">
                <div class="text-sm font-medium text-navy">Toyota Avanza</div>
                <div class="text-sm text-gray-custom">B 1234 ABC</div>
            </div>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Mobil Keluarga</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-navy font-semibold">Rp 300.000</td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Tersedia</span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
            <div class="flex text-yellow-400 text-sm">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
            </div>
            <span class="ml-1 text-sm text-gray-custom">4.8</span>
        </div>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <div class="flex space-x-2">
            <button class="text-blue-600 hover:text-blue-900 transition duration-300" title="Lihat Detail">
                <i class="fas fa-eye"></i>
            </button>
            <button class="text-green-600 hover:text-green-900 transition duration-300" title="Edit">
                <i class="fas fa-edit"></i>
            </button>
            <button class="text-red-600 hover:text-red-900 transition duration-300" title="Hapus">
                <i class="fas fa-trash"></i>
            </button>
        </div>
    </td>
</tr>
--}}

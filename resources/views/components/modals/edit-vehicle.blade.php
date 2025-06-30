<div id="editVehicleModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-3xl p-6 relative">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Edit Kendaraan</h2>
            <button type="button" id="cancelEditModal" class="text-gray-500 hover:text-red-600 text-xl">&times;</button>
        </div>

        <form id="editVehicleForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="editVehicleId" name="vehicle_id">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="editBrand" class="block text-sm font-medium text-gray-700">Merk</label>
                    <input type="text" id="editBrand" name="brand" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                </div>

                <div>
                    <label for="editModel" class="block text-sm font-medium text-gray-700">Model</label>
                    <input type="text" id="editModel" name="model" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                </div>

                <div>
                    <label for="editLicensePlate" class="block text-sm font-medium text-gray-700">Plat Nomor</label>
                    <input type="text" id="editLicensePlate" name="license_plate" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                </div>

                <div>
                    <label for="editYear" class="block text-sm font-medium text-gray-700">Tahun</label>
                    <input type="number" id="editYear" name="year" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                </div>

                <div>
                    <label for="editDailyPrice" class="block text-sm font-medium text-gray-700">Harga / Hari</label>
                    <input type="number" id="editDailyPrice" name="daily_price" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                </div>

                <div>
                    <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="editStatus" name="status"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gold focus:border-gold">
                        <option value="tersedia">Tersedia</option>
                        <option value="disewa">Disewa</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="unavailable">Tidak Tersedia</option>
                    </select>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" id="cancelEditModal"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-gold text-white rounded-md hover:bg-gold-dark">Simpan</button>
            </div>
        </form>
    </div>
</div>

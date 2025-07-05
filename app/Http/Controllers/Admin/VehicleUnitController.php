<?php
// app/Http/Controllers/Admin/VehicleUnitController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleUnit;
use App\Http\Requests\StoreVehicleUnitRequest;
use App\Http\Requests\UpdateVehicleUnitRequest;

class VehicleUnitController extends Controller
{
    /**
     * Menyimpan unit kendaraan baru untuk model kendaraan tertentu.
     */
    public function store(StoreVehicleUnitRequest $request, Vehicle $vehicle)
    {
        $data = $request->validated();
        $unit = $vehicle->units()->create($data);

        // Jika ini permintaan AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Unit Kendaraan (Plat No: ' . $data['license_plate'] . ') berhasil ditambahkan.',
                'unit' => $unit,
            ], 201);
        }

        // Jika bukan AJAX, lakukan redirect
        return redirect()->route('admin.vehicles.show', $vehicle->id)
            ->with('success_message', 'Unit Kendaraan (Plat No: ' . $data['license_plate'] . ') berhasil ditambahkan.');
    }

    /**
     * Memperbarui unit kendaraan yang spesifik.
     */
    public function update(UpdateVehicleUnitRequest $request, Vehicle $vehicle, VehicleUnit $unit)
    {
        $data = $request->validated();
        $unit->update($data);

        // Jika ini permintaan AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Unit Kendaraan (Plat No: ' . $data['license_plate'] . ') berhasil diperbarui.',
                'unit' => $unit,
            ]);
        }

        // Jika bukan AJAX, lakukan redirect
        return redirect()->route('admin.vehicles.show', $vehicle->id)
            ->with('success_message', 'Unit Kendaraan (Plat No: ' . $data['license_plate'] . ') berhasil diperbarui.');
    }

    /**
     * Menghapus unit kendaraan yang spesifik.
     */
    public function destroy(Request $request, Vehicle $vehicle, VehicleUnit $unit)
    {
        $licensePlate = $unit->license_plate;
        $unit->delete();

        // Jika ini permintaan AJAX, kembalikan JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Unit Kendaraan (Plat No: ' . $licensePlate . ') berhasil dihapus.',
            ]);
        }

        // Jika bukan AJAX, lakukan redirect
        return redirect()->route('admin.vehicles.show', $vehicle->id)
            ->with('success_message', 'Unit Kendaraan (Plat No: ' . $licensePlate . ') berhasil dihapus.');
    }
}

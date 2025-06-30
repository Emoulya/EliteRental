<?php
// app\Http\Controllers\Admin\VehicleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $total = Vehicle::count();
        $tersedia = Vehicle::where('status', 'tersedia')->count();
        $disewa = Vehicle::where('status', 'disewa')->count();
        $maintenance = Vehicle::where('status', 'maintenance')->count();
        $unavailable = Vehicle::where('status', 'unavailable')->count();

        $vehicles = Vehicle::latest()->get(); // Ambil semua kendaraan, bisa gunakan paginate() juga
        return view('admin.vehicles', compact('vehicles', 'total', 'tersedia', 'disewa', 'maintenance', 'unavailable'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'category' => 'required|string',
            'license_plate' => 'required|string|unique:vehicles',
            'year' => 'required|integer',
            'color' => 'required|string',
            'status' => 'required|string',
            'passenger_capacity' => 'nullable|integer',
            'transmission_type' => 'nullable|string',
            'fuel_type' => 'nullable|string',
            'air_conditioning' => 'nullable|string',
            'daily_price' => 'nullable|integer',
            'original_daily_price' => 'nullable|integer',
            'weekly_price' => 'nullable|integer',
            'monthly_price' => 'nullable|integer',
            'engine_type' => 'nullable|string',
            'max_power' => 'nullable|string',
            'max_torque' => 'nullable|string',
            'transmission' => 'nullable|string',
            'fuel_efficiency' => 'nullable|string',
            'length' => 'nullable|integer',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'wheelbase' => 'nullable|integer',
            'tank_capacity' => 'nullable|integer',
            'features' => 'nullable|array',
            'elite_features' => 'nullable|array',
            'long_description' => 'nullable|string',
            'rental_requirements' => 'nullable|string',
            'rental_terms' => 'nullable|string',
            'deposit_payment_info' => 'nullable|string',
            'prohibitions' => 'nullable|string',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan gambar utama
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        }

        // Simpan gambar galeri
        if ($request->hasFile('gallery_images')) {
            $paths = [];
            foreach ($request->file('gallery_images') as $image) {
                $paths[] = $image->store('vehicles/gallery', 'public');
            }
            $data['gallery_images'] = json_encode($paths);
        }

        // Pastikan fitur dan elite_features adalah string JSON
        $data['features'] = json_encode($data['features'] ?? []);
        $data['elite_features'] = json_encode($data['elite_features'] ?? []);

        Vehicle::create($data);

        // UBAH DARI 'custom_message' MENJADI 'success_message'
        return redirect()->route('admin.vehicles')->with('success_message', 'Kendaraan berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // Hapus gambar utama
        if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
            Storage::disk('public')->delete($vehicle->main_image);
        }

        // Hapus galeri
        if ($vehicle->gallery_images) {
            $galleryImages = json_decode($vehicle->gallery_images, true);
            foreach ($galleryImages as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $vehicle->delete();

        // Konsolidasikan pesan menjadi satu 'success_message'
        return redirect()->route('admin.vehicles')->with('success_message', 'Kendaraan berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $data = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:vehicles,license_plate,' . $id,
            'year' => 'required|integer',
            'status' => 'required|string',
            'daily_price' => 'required|integer',
        ]);

        $vehicle->update($data);

        return redirect()->route('admin.vehicles')
            ->with('success_message', 'Kendaraan berhasil diperbarui.');
    }
}

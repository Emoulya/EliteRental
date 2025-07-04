<?php
// app\Http\Controllers\Admin\VehicleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

class VehicleController extends Controller
{
    public function index()
    {
        $total = Vehicle::count();
        $tersedia = Vehicle::where('status', 'tersedia')->count();
        $disewa = Vehicle::where('status', 'disewa')->count();
        $maintenance = Vehicle::where('status', 'maintenance')->count();
        $unavailable = Vehicle::where('status', 'unavailable')->count();

        $vehicles = Vehicle::latest()->paginate(10);

        return view('admin.vehicles', compact('vehicles', 'total', 'tersedia', 'disewa', 'maintenance', 'unavailable'));
    }

    /**
     * Menampilkan formulir untuk membuat kendaraan baru.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    public function store(StoreVehicleRequest $request) 
    {
        $data = $request->validated();

        // Simpan gambar utama
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        } else {
            $data['main_image'] = null;
        }

        // Simpan gambar galeri
        if ($request->hasFile('gallery_images')) {
            $paths = [];
            foreach ($request->file('gallery_images') as $image) {
                $paths[] = $image->store('vehicles/gallery', 'public');
            }
            $data['gallery_images'] = $paths;
        } else {
            $data['gallery_images'] = [];
        }

        Vehicle::create($data);

        return redirect()->route('admin.vehicles')->with('success_message', 'Kendaraan berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit kendaraan yang spesifik.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $data = $request->validated();

        // Handle main image update
        if ($request->hasFile('main_image')) {
            if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
                Storage::disk('public')->delete($vehicle->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        } elseif ($request->boolean('clear_main_image')) {
            if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
                Storage::disk('public')->delete($vehicle->main_image);
            }
            $data['main_image'] = null;
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru dan tidak dihapus
            // Pastikan kunci 'main_image' tidak ditimpa dengan null jika tidak ada perubahan
            if (!isset($data['main_image'])) {
                $data['main_image'] = $vehicle->main_image;
            }
        }

        // Handle gallery images update
        // Pastikan $vehicle->gallery_images selalu array sebelum digunakan
        $existingGalleryImages = $vehicle->gallery_images ?? [];
        $updatedGalleryImages = $request->input('existing_gallery_images', []);
        $newGalleryImages = [];

        foreach ($existingGalleryImages as $imagePath) {
            if (!in_array($imagePath, $updatedGalleryImages) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $newGalleryImages[] = $image->store('vehicles/gallery', 'public');
            }
        }

        // Gabungkan gambar yang dipertahankan dan gambar baru
        $data['gallery_images'] = array_merge($updatedGalleryImages, $newGalleryImages);

        $vehicle->update($data);

        // Setelah berhasil, redirect ke halaman daftar kendaraan
        return redirect()->route('admin.vehicles')
            ->with('success_message', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        // Hapus gambar utama
        if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
            Storage::disk('public')->delete($vehicle->main_image);
        }

        // Hapus galeri
        if ($vehicle->gallery_images) { // Ini sudah array karena $casts
            foreach ($vehicle->gallery_images as $image) { // Langsung loop array
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $vehicle->delete();

        return redirect()->route('admin.vehicles')->with('success_message', 'Kendaraan berhasil dihapus!');
    }
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicle-detail', compact('vehicle'));
    }
}

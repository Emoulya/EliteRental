<?php
// app\Http\Controllers\Admin\VehicleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function store(StoreVehicleRequest $request) // Menggunakan Form Request
    {
        $data = $request->validated(); // Data sudah tervalidasi

        // Simpan gambar utama
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        } else {
            $data['main_image'] = null; // Pastikan null jika tidak ada gambar
        }

        // Simpan gambar galeri
        if ($request->hasFile('gallery_images')) {
            $paths = [];
            foreach ($request->file('gallery_images') as $image) {
                $paths[] = $image->store('vehicles/gallery', 'public');
            }
            $data['gallery_images'] = json_encode($paths); // Laravel akan meng-cast ini ke array karena $casts di model
        } else {
            $data['gallery_images'] = null; // Pastikan kosong jika tidak ada gambar galeri baru
        }

        Vehicle::create($data);

        // Jika ini adalah permintaan AJAX, kembalikan respons JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Kendaraan berhasil ditambahkan.',
                'success' => true,
                'vehicle' => $data // Opsional: kembalikan data kendaraan yang baru dibuat
            ], 201); // 201 Created
        }

        // Jika bukan AJAX, lakukan redirect seperti biasa
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

    public function update(UpdateVehicleRequest $request, $id) // Menggunakan Form Request
    {
        $vehicle = Vehicle::findOrFail($id);
        $data = $request->validated();

        // Handle main image update
        if ($request->hasFile('main_image')) {
            // Hapus gambar lama jika ada
            if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
                Storage::disk('public')->delete($vehicle->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        } elseif ($request->boolean('clear_main_image')) { // Opsional: Tambahkan input hidden untuk menghapus gambar
            if ($vehicle->main_image && Storage::disk('public')->exists($vehicle->main_image)) {
                Storage::disk('public')->delete($vehicle->main_image);
            }
            $data['main_image'] = null;
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru dan tidak diminta dihapus
            unset($data['main_image']);
        }


        // Handle gallery images update
        $existingGalleryImages = $vehicle->gallery_images ?? []; // Sudah di-cast oleh model
        $updatedGalleryImages = $request->input('existing_gallery_images', []); // Gambar yang masih dipertahankan
        $newGalleryImages = [];

        // Hapus gambar galeri lama yang tidak ada di updatedGalleryImages
        foreach ($existingGalleryImages as $imagePath) {
            if (!in_array($imagePath, $updatedGalleryImages) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Tambahkan gambar galeri baru
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $newGalleryImages[] = $image->store('vehicles/gallery', 'public');
            }
        }

        // Gabungkan gambar yang dipertahankan dan gambar baru
        $data['gallery_images'] = array_merge($updatedGalleryImages, $newGalleryImages); // Laravel akan meng-encode ini

        $vehicle->update($data);

        // Jika ini adalah permintaan AJAX, kembalikan respons JSON
        if ($request->ajax()) {
            return response()->json([
                'message' => 'Kendaraan berhasil diperbarui.',
                'success' => true,
                'vehicle' => $data // Opsional: kembalikan data kendaraan yang baru diperbarui
            ], 200);
        }


        return redirect()->route('admin.vehicles')
            ->with('success_message', 'Kendaraan berhasil diperbarui.');
    }
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicle-detail', compact('vehicle'));
    }
}

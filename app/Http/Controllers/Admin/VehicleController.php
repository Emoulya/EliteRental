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
    public function index(Request $request)
    {
        // Ambil parameter filter dari request
        $search = $request->input('search');
        $categoryFilter = $request->input('category_filter');
        $statusFilter = $request->input('status_filter');
        $priceFilter = $request->input('price_filter');

        // Mulai dengan query dasar untuk Vehicle
        $query = Vehicle::query();

        // Terapkan filter berdasarkan input
        $query->when($search, function ($q) use ($search) {
            $q->where('brand', 'like', '%' . $search . '%')
                ->orWhere('model', 'like', '%' . $search . '%')
                ->orWhere('license_plate', 'like', '%' . $search . '%');
        });

        $query->when($categoryFilter, function ($q) use ($categoryFilter) {
            $q->where('category', $categoryFilter);
        });

        $query->when($priceFilter, function ($q) use ($priceFilter) {
            $prices = explode('-', $priceFilter);
            $minPrice = (int) $prices[0];
            $maxPrice = (int) $prices[1];

            $q->whereBetween('daily_price', [$minPrice, $maxPrice]);
        });

        $query->when($statusFilter, function ($q) use ($statusFilter) {
            $q->where('status', $statusFilter);
        });

        // Ambil kendaraan yang sudah difilter dengan paginasi
        $vehicles = $query->latest()->paginate(10)->withQueryString(); // Tambahkan withQueryString() agar paginasi mempertahankan filter

        // Hitungan untuk kartu statistik (saat ini tetap global, tidak terpengaruh filter)
        $total = Vehicle::count();
        $tersedia = Vehicle::where('status', 'tersedia')->count();
        $disewa = Vehicle::where('status', 'disewa')->count();
        $maintenance = Vehicle::where('status', 'maintenance')->count();
        $unavailable = Vehicle::where('status', 'unavailable')->count();

        // Jika ini adalah permintaan AJAX, kembalikan hanya HTML tabel dan paginasi dalam format JSON
        if ($request->ajax()) {
            return response()->json([
                'table_html' => view('admin.vehicles._table_rows', compact('vehicles'))->render(),
                'pagination_html' => $vehicles->links()->toHtml(),
                'total_vehicles_count' => $vehicles->total(),
            ]);
        }

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
            if (!isset($data['main_image'])) {
                $data['main_image'] = $vehicle->main_image;
            }
        }

        // Handle gallery images update
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

        $data['gallery_images'] = array_merge($updatedGalleryImages, $newGalleryImages);

        $vehicle->update($data);

        $referrer = $request->input('_referrer');
        if ($referrer === 'detail') {
            return redirect()->route('admin.vehicles.show', $vehicle->id)
                ->with('success_message', 'Kendaraan berhasil diperbarui.');
        } else {
            return redirect()->route('admin.vehicles')
                ->with('success_message', 'Kendaraan berhasil diperbarui.');
        }
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
            foreach ($vehicle->gallery_images as $image) {
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

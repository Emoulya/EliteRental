<?php
// app\Http\Controllers\Admin\VehicleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleUnit;
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

        $query = Vehicle::query();

        // Terapkan filter berdasarkan atribut Model Kendaraan
        $query->when($search, function ($q) use ($search) {
            $q->where('brand', 'like', '%' . $search . '%')
                ->orWhere('model', 'like', '%' . $search . '%');
        });

        $query->when($categoryFilter, function ($q) use ($categoryFilter) {
            $q->where('category', $categoryFilter);
        });

        // Logika filter berdasarkan status unit kendaraan
        $query->when($statusFilter, function ($q) use ($statusFilter) {
            $q->whereHas('units', function ($unitQuery) use ($statusFilter) {
                $unitQuery->where('status', $statusFilter);
            });
        });

        // Logika filter harga berdasarkan daily_price Model Kendaraan
        $query->when($priceFilter, function ($q) use ($priceFilter) {
            $prices = explode('-', $priceFilter);
            $minPrice = (int) $prices[0];
            $maxPrice = (int) $prices[1];

            $q->whereBetween('daily_price', [$minPrice, $maxPrice]);
        });

        // Ambil model kendaraan yang sudah difilter dengan paginasi
        $vehicles = $query->withCount('units')->latest()->paginate(10)->withQueryString();

        // Hitungan untuk kartu statistik (sekarang berasal dari VehicleUnit)
        $totalUnits = VehicleUnit::count();
        $tersediaUnits = VehicleUnit::where('status', 'tersedia')->count();
        $disewaUnits = VehicleUnit::where('status', 'disewa')->count();
        $maintenanceUnits = VehicleUnit::where('status', 'maintenance')->count();
        $unavailableUnits = VehicleUnit::where('status', 'unavailable')->count();

        // Jika ini adalah permintaan AJAX, kembalikan hanya HTML tabel dan paginasi dalam format JSON
        if ($request->ajax()) {
            return response()->json([
                'table_html' => view('admin.vehicles._table_rows', compact('vehicles'))->render(),
                'pagination_html' => $vehicles->links()->toHtml(),
                'total_models_count' => $vehicles->total(),
            ]);
        }

        // Untuk permintaan halaman penuh, kembalikan tampilan lengkap
        return view('admin.vehicles', compact(
            'vehicles',
            'totalUnits',
            'tersediaUnits',
            'disewaUnits',
            'maintenanceUnits',
            'unavailableUnits'
        ));
    }

    /**
     * Menampilkan formulir untuk membuat model kendaraan baru.
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

        return redirect()->route('admin.vehicles')->with('success_message', 'Model Kendaraan berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit model kendaraan yang spesifik.
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
                ->with('success_message', 'Model Kendaraan berhasil diperbarui.');
        } else {
            return redirect()->route('admin.vehicles')
                ->with('success_message', 'Model Kendaraan berhasil diperbarui.');
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

        return redirect()->route('admin.vehicles')->with('success_message', 'Model Kendaraan berhasil dihapus!');
    }

    public function show(Vehicle $vehicle)
    {
        // Muat unit-unit kendaraan terkait untuk ditampilkan di halaman detail
        $vehicle->load('units');
        return view('admin.vehicle-detail', compact('vehicle'));
    }
}

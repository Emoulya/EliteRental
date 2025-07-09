<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleListController extends Controller
{
    /**
     * Menampilkan daftar semua kendaraan yang tersedia untuk pelanggan.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoryFilter = $request->input('category_filter');
        $priceFilter = $request->input('price_filter');
        $availabilityFilter = $request->input('availability_filter');

        $query = Vehicle::query();

        // Eager load units dan hitung unit yang tersedia
        $query->withCount(['units as total_units_count'])
            ->withCount(['units as available_units_count' => function ($q) {
                $q->where('status', 'tersedia');
            }]);

        // Terapkan filter umum menggunakan scope
        $query->applyFilters($search, $categoryFilter, $priceFilter);

        // Filter berdasarkan ketersediaan unit
        $query->when($availabilityFilter === 'available', function ($q) {
            $q->whereHas('units', function ($unitQuery) {
                $unitQuery->where('status', 'tersedia');
            });
        });
        // Jika status yang dicari adalah 'not_available', maka kendaraan akan ditampilkan jika ada setidaknya satu unit dengan status selain 'tersedia'
        $query->when($availabilityFilter === 'not_available', function ($q) {
            $q->whereHas('units', function ($unitQuery) {
                $unitQuery->where('status', '!=', 'tersedia');
            });
        });

        $vehicles = $query->paginate(12)->withQueryString();

        // Jika permintaan adalah AJAX, kembalikan JSON dengan HTML kartu kendaraan dan link paginasi
        if ($request->ajax()) {
            return response()->json([
                'vehicle_cards_html' => view('partials.vehicle_cards', ['vehicles' => $vehicles])->render(),
                'pagination_html' => $vehicles->links()->toHtml(),
                'total_vehicles' => $vehicles->total(),
            ]);
        }

        // Untuk permintaan halaman penuh, kembalikan view lengkap
        return view('pages.vehicles', compact('vehicles'));
    }
}

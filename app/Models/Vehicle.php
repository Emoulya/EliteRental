<?php
// app\Models\Vehicle.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        // Informasi Dasar
        'brand',
        'model',
        'category',
        'year',
        'color',

        // Spesifikasi & Harga
        'passenger_capacity',
        'transmission_type',
        'fuel_type',
        'daily_price',
        'original_daily_price',
        'weekly_price',
        'monthly_price',
        'engine_type',
        'max_power',
        'max_torque',
        'transmission',
        'fuel_efficiency',

        // Dimensi & Kapasitas
        'length',
        'width',
        'height',
        'wheelbase',
        'tank_capacity',

        // Deskripsi & Syarat
        'long_description',
        'rental_requirements',
        'rental_terms',
        'deposit_payment_info',
        'prohibitions',

        // File upload
        'main_image',
        'gallery_images',

        // Fitur
        'additional_features',
        'features',
        'elite_features',
    ];

    protected $casts = [
        'additional_features' => 'array',
        'elite_features' => 'array',
        'gallery_images' => 'array',
    ];

    /**
     * Dapatkan unit-unit kendaraan untuk model kendaraan ini.
     */
    public function units(): HasMany
    {
        return $this->hasMany(VehicleUnit::class); // Relasi ke model VehicleUnit
    }

    /**
     * Accessor untuk mendapatkan kelas ikon Font Awesome berdasarkan fitur utama.
     */
    public function getFeatureIconAttribute(): string
    {
        switch ($this->features) {
            case 'ac':
                return 'fas fa-snowflake';
            case 'air_vent':
                return 'fas fa-wind';
            case 'helmet':
                return 'fas fa-helmet-safety';
            case 'open_tub':
                return 'fas fa-truck-pickup';
            default:
                return 'fas fa-check-circle'; // Ikon default jika fitur tidak dikenali
        }
    }

}

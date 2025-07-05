<?php
// app/Models/VehicleUnit.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleUnit extends Model
{
    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'vehicle_units'; // Tentukan nama tabel yang sesuai dengan migrasi

    /**
     * Atribut yang bisa diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'license_plate',
        'status',
    ];

    /**
     * Casting atribut.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string', // Pastikan status di-cast sebagai string jika diperlukan
    ];

    /**
     * Dapatkan model kendaraan yang memiliki unit ini.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class); // Relasi ke model Vehicle
    }
}
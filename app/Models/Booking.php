<?php
// app\Models\Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_unit_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'notes',
        'duration_type',
        'quantity',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'status' => 'string',
    ];

    /**
     * Dapatkan user yang memiliki booking ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Dapatkan unit kendaraan yang dipesan.
     */
    public function vehicleUnit(): BelongsTo
    {
        return $this->belongsTo(VehicleUnit::class);
    }
}

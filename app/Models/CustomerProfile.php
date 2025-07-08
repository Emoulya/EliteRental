<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'ktp_number',
        'sim_number',
        'full_address',
    ];

    /**
     * Dapatkan user yang memiliki profil ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

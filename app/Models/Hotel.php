<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'address',
        'price_night',
        'destination_id'
    ];

    public function reservations():HasMany{
        return $this->hasMany(Reservation::class);
    }

    public function destination():BelongsTo{
        return $this->belongsTo(Destination::class);
    }
}

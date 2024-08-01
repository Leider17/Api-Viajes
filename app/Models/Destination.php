<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\Activity;
use App\Models\Reservation;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Destination extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'country',
        'description',
        'image'
    ];

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);

    }

    public function activities():HasMany{
        return $this->hasMany(Activity::class);
    }

    public function reservations():HasMany{
        return $this->hasMany(Reservation::class);
    }

    public function hotels():HasMany{
        return $this->hasMany(Hotel::class);
    }
}

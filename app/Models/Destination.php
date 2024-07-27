<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use app\Models\Activity;
use app\Models\Reservation;
use app\Models\Hotel;
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

    public function hotels(){
        return $this->hasMany(Hotel::class);
    }
}

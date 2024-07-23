<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

   protected $fillable=[
    'content',
    'user_id',
    'destination_id'
   ];

   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class);
   }

   public function destination(): BelongsTo
   {
       return $this->belongsTo(Destination::class);
   }
}

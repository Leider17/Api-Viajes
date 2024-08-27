<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserReservationResource;

class UserController extends Controller
{
    public function userReservations($id){
        $user=User::with('reservations')->findOrFail($id);

        return response()->json(new UserReservationResource($user), 200);
    }
}

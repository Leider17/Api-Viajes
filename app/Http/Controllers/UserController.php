<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserReservationResource;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index():JsonResponse{
        return response()->json(User::all(), 200);
    }

    public function show($id):JsonResponse{
        $user = User::find($id);
        return response()->json(
            $user,200
        );
    }
    public function store(UserRequest $request):JsonResponse{

        $user = User::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$user],201
        );
    }

    public function update($id,UserRequest $request):JsonResponse{
        $user = User::find($id);
        $user->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    public function destroy($id){
        User::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
    public function userReservations($id){
        $user=User::with('reservations')->findOrFail($id);

        return response()->json(new UserReservationResource($user), 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index():JsonResponse{
        return response()->json(Hotel::all(), 200);
    }

    public function show($id):JsonResponse{
        $hotel = Hotel::find($id);
        return response()->json(
            $hotel,200
        );
    }
    public function store(HotelRequest $request):JsonResponse{

        $hotel = Hotel::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$hotel],201
        );
    }

    public function update($id,HotelRequest $request):JsonResponse{
        $comment = Hotel::find($id);
        $comment->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    public function destroy($id){
        Hotel::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

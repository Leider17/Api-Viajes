<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestinationRequest;
use App\Http\Resources\DestinationResource;
use App\Http\Resources\DestinationHotelResource;
use App\Http\Resources\DestinationActivityResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Destination;


class DestinationController extends Controller
{
    public function index():JsonResponse{
       
        return response()->json(Destination::all(), 200);
    }

    public function DestinationsComments():JsonResponse{

        return response()->json(DestinationResource::collection(Destination::all()), 200);
    }

    public function DestinationComments($id):JsonResponse
    {
        $destination=Destination::with('comments')->findOrFail($id);
        return response()->json(new DestinationResource($destination), 200);
    }

    public function DestinationsHotels():JsonResponse{
        return response()->json(DestinationHotelResource::collection(Destination::all()),200);
    }
    public function DestinationHotels($id):JsonResponse{
        $destination = Destination::with('hotels')->findOrFail($id);
        return response()->json(new DestinationHotelResource($destination),200);
    }

    public function DestinationsActivities():JsonResponse{
        return response()->json(DestinationActivityResource::collection(Destination::all()),200);
    }

    public function DestinationActivities($id):JsonResponse{
        $destination= Destination::with('activities')->findOrFail($id);
        return response()->json(new DestinationActivityResource($destination),200);
    }
    public function store(DestinationRequest $request):JsonResponse{

        $destination = Destination::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$destination],201
        );
    }

    public function show($id){
        $destination = Destination::find($id);
        return response()->json(
            $destination,200
        );
    }

    public function update(){

    }

    public function destroy(){

    }
}

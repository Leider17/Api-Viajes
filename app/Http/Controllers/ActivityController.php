<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    
    public function index():JsonResponse{
        return response()->json(Activity::all(), 200);
    }

    public function show($id):JsonResponse{
        $activity = Activity::find($id);
        return response()->json(
            $activity,200
        );
    }
    public function store(ActivityRequest $request):JsonResponse{

        $activity = Activity::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$activity],201
        );
    }

    public function update($id,ActivityRequest $request):JsonResponse{
        $activity = Activity::find($id);
        $activity->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    public function destroy($id){
        Activity::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

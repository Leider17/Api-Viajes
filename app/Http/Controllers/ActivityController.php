<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *         title="API Swagger",
 *          version="1.0",
 *          description="API CRUD viajes"
 * )
 * 
 * @OA/Server(url=http://localhost)
 */

class ActivityController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/activities",
     *      tags={"Activities"},
     *      summary="Obtener listado de actividades",
     *      description="Devuelve un listado de actividades",
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/ActivityResource")
     * )
     )
     )
     */
    public function index():JsonResponse{
        return response()->json(Activity::all(), 200);
    }
   /**
     * @OA\Get(
     *     path="/api/activities/{id}",
     *     tags={"Activities"},
     *     summary="Obtener información de una actividad",
     *     description="Devuelve los datos de una actividad específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la actividad",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/ActivityResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Actividad no encontrada"
     *     )
     * )
     */
    public function show($id):JsonResponse{
        $activity = Activity::find($id);
        return response()->json(
            $activity,200
        );
    }

  /**
     * @OA\Post(
     *     path="/api/activities",
     *     tags={"Activities"},
     *     summary="Crear nueva actividad",
     *     description="Crea una nueva actividad",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityResource")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Actividad creada exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/ActivityResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(ActivityRequest $request):JsonResponse{

        $activity = Activity::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$activity],201
        );
    }

    /**
     * @OA\Put(
     *     path="/api/activities/{id}",
     *     tags={"Activities"},
     *     summary="Actualizar actividad existente",
     *     description="Actualiza los datos de una actividad específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la actividad",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ActivityResource")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actividad actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Actividad no encontrada"
     *     )
     * )
     */
    public function update($id, ActivityRequest $request): JsonResponse 
{
    $activity = Activity::findOrFail($id);
    $activity->update($request->all());

    return response()->json([
        'success' => true
    ], 200);
}
    /**
     * @OA\Delete(
     *     path="/api/activities/{id}",
     *     tags={"Activities"},
     *     summary="Eliminar una actividad",
     *     description="Elimina una actividad específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la actividad",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Actividad eliminada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Actividad no encontrada"
     *     )
     * )
     */
    public function destroy($id):JsonResponse{
        Activity::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

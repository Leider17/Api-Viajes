<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HotelController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/hotels",
     *      tags={"Hotels"},
     *      summary="Obtener listado de hoteles",
     *      description="Devuelve un listado de hoteles",
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/HotelResource")
     * )
     )
     )
     */
    public function index():JsonResponse{
        return response()->json(Hotel::all(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/hotels/{id}",
     *     tags={"Hotels"},
     *     summary="Obtener información de un hotel",
     *     description="Devuelve los datos de un hotel específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del hotel",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/HotelResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel no encontrado"
     *     )
     * )
     */
    public function show($id):JsonResponse{
        $hotel = Hotel::find($id);
        return response()->json(
            $hotel,200
        );
    }

     /**
     * @OA\Post(
     *     path="/api/hotels",
     *     tags={"Hotels"},
     *     summary="Crear nuevo hotel",
     *     description="Crea un nuevo hotel",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/HotelResource")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="hotel creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/HotelResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(HotelRequest $request):JsonResponse{

        $hotel = Hotel::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$hotel],201
        );
    }

    /**
     * @OA\Put(
     *     path="/api/hotels/{id}",
     *     tags={"Hotels"},
     *     summary="Actualizar hotel existente",
     *     description="Actualiza los datos de un hotel especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del hotel",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/HotelResource")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="hotel actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel no encontrado"
     *     )
     * )
     */
    public function update($id,HotelRequest $request):JsonResponse{
        $comment = Hotel::find($id);
        $comment->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/hotels/{id}",
     *     tags={"Hotels"},
     *     summary="Eliminar un hotel",
     *     description="Elimina un hotel especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del hotel",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="hotel eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="hotel no encontrado"
     *     )
     * )
     */
    public function destroy($id):JsonResponse{
        Hotel::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

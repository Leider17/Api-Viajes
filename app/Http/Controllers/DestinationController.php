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

    /**
     * @OA\Get(
     *      path="/api/Destinations",
     *      tags={"Destinations"},
     *      summary="Obtener listado de destinos",
     *      description="Devuelve un listado de destinos",
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/DestinationResource")
     * )
     )
     )
     */
    public function index():JsonResponse{
       
        return response()->json(Destination::all(), 200);
    }
/**
     * @OA\Get(
     *      path="/api/Destinations/Comments",
     *      tags={"Destinations"},
     *      summary="Obtener listado de destinos junto con sus comentarios",
     *      description="Devuelve un listado de destinos junto con sus comentarios",
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/DestinationResource")
     * )
     )
     )
     */
    public function DestinationsComments():JsonResponse{

        return response()->json(DestinationResource::collection(Destination::all()), 200);
    }

    /**
     * @OA\Get(
     *      path="/api/Destinations/{id}/Comments",
     *      tags={"Destinations"},
     *      summary="Obtener comentarios de un destino específico",
     *      description="Devuelve los comentarios relacionados con un destino por su ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID del destino",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(ref="#/components/schemas/DestinationResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Destino no encontrado"
     *      )
     * )
     */
    public function DestinationComments($id):JsonResponse
    {
        $destination=Destination::with('comments')->findOrFail($id);
        return response()->json(new DestinationResource($destination), 200);
    }

    /**
     * @OA\Get(
     *      path="/api/Destinations/Hotels",
     *      tags={"Destinations"},
     *      summary="Obtener hoteles de todos los destinos",
     *      description="Devuelve los hoteles relacionados con todos los destinos",
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/DestinationHotelResource")
     *          )
     *      )
     * )
     */
    public function DestinationsHotels():JsonResponse{
        //return response()->json(DestinationHotelResource::collection(Destination::all()),200);
        dd(Destination::all());
    }
    /**
     * @OA\Get(
     *      path="/api/Destinations/{id}/Hotels",
     *      tags={"Destinations"},
     *      summary="Obtener hoteles de un destino específico",
     *      description="Devuelve los hoteles relacionados con un destino por su ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID del destino",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(ref="#/components/schemas/DestinationHotelResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Destino no encontrado"
     *      )
     * )
     */
    public function DestinationHotels($id):JsonResponse{
        $destination = Destination::with('hotels')->findOrFail($id);
        return response()->json(new DestinationHotelResource($destination),200);
    }

    /**
     * @OA\Get(
     *      path="/api/Destinations/Activities",
     *      tags={"Destinations"},
     *      summary="Obtener actividades de todos los destinos",
     *      description="Devuelve las actividades relacionadas con todos los destinos",
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/DestinationActivityResource")
     *          )
     *      )
     * )
     */
    public function DestinationsActivities():JsonResponse{
        return response()->json(DestinationActivityResource::collection(Destination::all()),200);
    }
    /**
     * @OA\Get(
     *      path="/api/Destinations/{id}/Activities",
     *      tags={"Destinations"},
     *      summary="Obtener hoteles de un destino específico",
     *      description="Devuelve los hoteles relacionados con un destino por su ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID del destino",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa",
     *          @OA\JsonContent(ref="#/components/schemas/DestinationHotelResource")
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Destino no encontrado"
     *      )
     * )
     */
    public function DestinationActivities($id):JsonResponse{
        $destination= Destination::with('activities')->findOrFail($id);
        return response()->json(new DestinationActivityResource($destination),200);
    }

    /**
     * @OA\Post(
     *     path="/api/Destinations",
     *     tags={"Destinations"},
     *     summary="Crear un nuevo destino",
     *     description="Crea un nuevo destino",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/DestinationResource")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Destino creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/DestinationResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(DestinationRequest $request):JsonResponse{

        $destination = Destination::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$destination],201
        );
    }

    /**
     * @OA\Get(
     *     path="/api/Destinations/{id}",
     *     tags={"Destinations"},
     *     summary="Obtener información de un destino",
     *     description="Devuelve los datos de un destino especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del destino",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/DestinationResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Destino no encontrado"
     *     )
     * )
     */
    public function show($id):JsonResponse{
        $destination = Destination::find($id);
        return response()->json(
            $destination,200
        );
    }

    /**
     * @OA\Put(
     *     path="/api/Destinations/{id}",
     *     tags={"Destinations"},
     *     summary="Actualizar destino existente",
     *     description="Actualiza los datos de un destino específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del destino",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/DestinationResource")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Destino actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Destino no encontrado"
     *     )
     * )
     */
    public function update($id,DestinationRequest $request):JsonResponse{
        $destination = Destination::find($id);
        $destination->update($request->all());

        return response()->json([
            'success'=>true]
            ,200);
    }
    /**
     * @OA\Delete(
     *     path="/api/Destinations/{id}",
     *     tags={"Destinations"},
     *     summary="Eliminar un destino",
     *     description="Elimina un destino específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del destino",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Destino eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Destino no encontrado"
     *     )
     * )
     */
    public function destroy($id):JsonResponse{
        Destination::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

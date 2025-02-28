<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/comments",
     *      tags={"Comments"},
     *      summary="Obtener listado de comentarios",
     *      description="Devuelve un listado de comentarios",
     *      @OA\Response(
     *          response=200,
     *          description="Operacion exitosa",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/CommentResource")
     * )
     )
     )
     */
    public function index():JsonResponse{
        return response()->json(Comment::all(), 200);
    }

     /**
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Obtener información de un comentario",
     *     description="Devuelve los datos de un comentario especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="comentario no encontrado"
     *     )
     * )
     */
    public function show($id):JsonResponse{
        $comment = Comment::find($id);
        return response()->json(
            $comment,200
        );
    }

     /**
     * @OA\Post(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Crear nuevo comentario",
     *     description="Crea un nuevo comentario",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Comentario creado exitosamente",
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Datos inválidos"
     *     )
     * )
     */
    public function store(CommentRequest $request):JsonResponse{

        $comment = Comment::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$comment],201
        );
    }

     /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Actualizar comentario existente",
     *     description="Actualiza los datos de un comentario especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */
    public function update($id,CommentRequest $request):JsonResponse{
        $comment = Comment::find($id);
        $comment->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     tags={"Comments"},
     *     summary="Eliminar un comentario",
     *     description="Elimina un comentario especifico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del comentario",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comentario eliminado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Comentario no encontrado"
     *     )
     * )
     */
    public function destroy($id):JsonResponse{
        Comment::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

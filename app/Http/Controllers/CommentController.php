<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index():JsonResponse{
        return response()->json(Comment::all(), 200);
    }

    public function show($id):JsonResponse{
        $comment = Comment::find($id);
        return response()->json(
            $comment,200
        );
    }
    public function store(CommentRequest $request):JsonResponse{

        $comment = Comment::create($request->all());
        return response()->json(
            ['success'=>true, 'data'=>$comment],201
        );
    }

    public function update($id,CommentRequest $request):JsonResponse{
        $comment = Comment::find($id);
        $comment->update($request->all());

        return response()->json([
            'success'=>true],200
        );
    }

    public function destroy($id){
        Comment::find($id)->delete();
        return response()->json([
            'success'=>true]
            ,200);
    }
}

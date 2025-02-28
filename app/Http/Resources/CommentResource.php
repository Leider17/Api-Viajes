<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     /**
      * @OA\Schema(
            schema="CommentResource",
            type="object",
            @OA\Property(
                property="id",
                type="integer",
                description="Id of the comment"
            ),
            @OA\Property(
                property="content",
                type="string",
                description="Content of the comment"
            ),
            @OA\Property(
                property="user_id",
                type="integer",
                description="id of the user related to the comment"
            ),
            @OA\Property(
                property="name_user",
                type="string",
                description="Name of the user related to the comment"
            )
            )
      */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'user_id' => $this->user_id,
            'name_user'=>$this->user->name
            
        ];
    }
}

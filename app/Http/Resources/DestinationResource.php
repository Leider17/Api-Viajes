<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
        'id' => $this->id,
        'name' => $this->name,
        'country' => $this->country,
        'description' => $this->description,
        'image' => $this->image,
        'comments' => CommentResource::collection($this->comments),
        ];
    }

}

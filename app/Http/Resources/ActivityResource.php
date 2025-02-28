<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     /**
      * @OA\Schema(
            schema="ActivityResource",
            type="object",
            @OA\Property(
                property="id",
                type="integer",
                description="Id of the activity"
            ),
            @OA\Property(
                property="name",
                type="string",
                description="Name of the activity"
            ),
            @OA\Property(
                property="description",
                type="string",
                description="Description of the activity"
            ),
            @OA\Property(
                property="type",
                type="string",
                description="Type of the activity"
            )
            )
      */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->name,
            'type'=>$this->type
        ];
    }
}

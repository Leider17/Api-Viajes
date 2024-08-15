<?php

namespace App\Http\Resources;

use App\Http\Requests\ActivityRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country,
            'description' => $this->description,
            'image' => $this->image,
            'activities' => ActivityResource::collection($this->activities)
        ];
    }
}

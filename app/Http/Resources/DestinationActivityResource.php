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

     /**
 * @OA\Schema(
 *     schema="DestinationActivityResource",
 *     type="object",
 *     title="Destination Activity Resource",
 *     description="Estructura del recurso de destino",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID del destino"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del destino"
 *     ),
 *     @OA\Property(
 *         property="country",
 *         type="string",
 *         description="País del destino"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Descripción del destino"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         description="URL de la imagen del destino"
 *     ),
 *     @OA\Property(
 *         property="activities",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/HotelResource"),
 *         description="actividades asociadas al destino"
 *     )
 * )
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

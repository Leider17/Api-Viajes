<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DestinationHotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
     /**
 * @OA\Schema(
 *     schema="DestinationHotelResource",
 *     type="object",
 *     title="Destination Hotel Resource",
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
 *         property="hotels",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/HotelResource"),
 *         description="hoteles asociados al destino"
 *     )
 * )
 */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'name' => $this->name,
            'country' => $this->country,
            'description' => $this->description,
            'image' => $this->image,
            'hotels' => HotelResource::collection($this->hotels)
            ];
        }
    }


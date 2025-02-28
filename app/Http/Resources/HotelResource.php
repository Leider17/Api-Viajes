<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

      /**
 * @OA\Schema(
 *     schema="HotelResource",
 *     type="object",
 *     title="Hotel Resource",
 *     description="Estructura del recurso de hotel",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID del hotel"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nombre del hotel"
 *     ),
 *     @OA\Property(
 *         property="adress",
 *         type="string",
 *         description="direccion del hotel"
 *     ),
 *     @OA\Property(
 *         property="price_night",
 *         type="number",
 *         format="float",
 *         description="Precio por noche en el destino"
 *     )
 * )
 */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'address'=>$this->address,
            'price_night'=>$this->price_night
        ];
    }
}

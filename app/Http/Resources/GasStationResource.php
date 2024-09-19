<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GasStationResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name_station' => $this->name_station,
            'lng' => $this->lng,
            'lat' => $this->lat,
            'image' => $this->image,
            'address' => $this->address,
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

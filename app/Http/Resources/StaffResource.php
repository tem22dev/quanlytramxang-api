<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffResource extends JsonResource
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
            'gas_station_id' => $this->gas_station_id,
            'full_name' => $this->full_name,
            'tel' => $this->tel,
            'address' => $this->address,
            'birth_date' => $this->birth_date ? $this->birth_date->format('d-m-Y') : null,
            'position' => $this->position,
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

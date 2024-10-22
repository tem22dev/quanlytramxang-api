<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelResource extends JsonResource
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
            'type_fuel' => $this->type_fuel,
            'price' => number_format($this->price, 0, ',', '.') . ' đ',
            'price_number' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

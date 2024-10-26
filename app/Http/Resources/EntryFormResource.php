<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryFormResource extends JsonResource
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
            'gas_station' => $this->gasStation,
            'total_price' => $this->total_price,
            'total_price_format' => number_format($this->total_price, 0, ',', '.') . ' đ',
            'detail' => $this->detailEntryForms->map(function($detail) {
                return [
                    'id' => $detail->id,
                    'fuel' => $detail->fuel,
                    'quantity' => $detail->quantity,
                    'price' => $detail->price,
                    'price_format' => number_format($detail->price, 0, ',', '.') . 'đ',
                    'created_at' => $detail->created_at->format('H:i | d-m-Y'),
                ];
            }),
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

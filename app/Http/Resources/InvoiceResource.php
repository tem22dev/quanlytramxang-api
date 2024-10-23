<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'staff' => $this->staff,
            'total_price' => $this->total_price,
            'detail' => $this->detailInvoices->map(function($detail) {
                return [
                    'id' => $detail->id,
                    'fuel' => $detail->fuel,
                    'quantity' => $detail->quantity,
                    'price' => $detail->price,
                    'created_at' => $detail->created_at->format('H:i | d-m-Y'),
                ];
            }),
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

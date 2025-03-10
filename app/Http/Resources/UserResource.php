<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->full_name,
            'tel' => $this->tel,
            'email' => $this->email,
            'user_type' => $this->user_type,
            'created_at' => $this->created_at->format('H:i | d-m-Y'),
        ];
    }
}

<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class UpdateGasStationRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'name_station' => ['required', 'string'],
            'lng' => ['required'],
            'lat' => ['required'],
            'image' => ['nullable', 'string'],
            'address' => ['required']
        ];
    }
}

<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class UpdateFuelRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'type_fuel' => ['required'],
            'price' => ['required'],
            'description' => ['nullable', 'string'],
        ];
    }
}

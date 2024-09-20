<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class CreateStaffRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'gas_station_id' => ['required', 'exists:gas_stations,id'],
            'full_name' => ['required', 'string'],
            'tel' => ['required', 'numeric', 'digits:10', 'unique:staffs,tel'],
            'address' => ['nullable', 'string'],
            'birth_date' => ['nullable'],
            'position' => ['required', 'string'],
        ];
    }
}

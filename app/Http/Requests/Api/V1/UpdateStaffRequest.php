<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateStaffRequest extends BaseRequest
{
    public function rules(Request $request): array
    {
        $staffId = $request->route('staff');

        return [
            'gas_station_id' => ['required', 'exists:gas_stations,id'],
            'full_name' => ['required', 'string'],
            'tel' => [
                'required', 
                'numeric', 
                'digits:10',
                Rule::unique('staffs', 'tel')->ignore($staffId)
            ],
            'address' => ['nullable', 'string'],
            'birth_date' => ['nullable'],
            'position' => ['required', 'string'],
        ];
    }
}

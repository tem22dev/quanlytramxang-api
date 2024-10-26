<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class CreateEntryFormRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'gas_station_id' => ['required', 'exists:gas_stations,id'],
            'detail_entry_form' => ['required', 'array'],
            'detail_entry_form.*.fuel_id' => ['required', 'exists:fuels,id'],
            'detail_entry_form.*.quantity' => ['required', 'numeric', 'min:0.1'],
            'detail_entry_form.*.price' => ['required', 'numeric']
        ];
    }
}

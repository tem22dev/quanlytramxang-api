<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class CreateInvoiceRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'gas_station_id' => ['required', 'exists:gas_stations,id'],
            'staff_id' => ['required', 'exists:staffs,id'],
            'detail_invoice' => ['required', 'array'],
            'detail_invoice.*.fuel_id' => ['required', 'exists:fuels,id'],
            'detail_invoice.*.quantity' => ['required', 'numeric', 'min:0.1'],
            'detail_invoice.*.price' => ['required', 'numeric']
        ];
    }
}

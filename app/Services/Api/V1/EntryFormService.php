<?php

namespace App\Services\Api\V1;

use App\Http\Resources\EntryFormResource;
use App\Models\DetailEntryForm;
use App\Models\EntryForm;
use Illuminate\Support\Facades\DB;

class EntryFormService
{
    public function getList()
    {
        $entryForms = EntryForm::all();

        return EntryFormResource::collection($entryForms);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $entryForm = EntryForm::create([
                'gas_station_id' => $request->gas_station_id,
                'total_price' => 0
            ]);

            $totalPrice = 0;

            foreach ($request->detail_entry_form as $detail) {
                $detailEntryForm = DetailEntryForm::create([
                    'entry_form_id' => $entryForm->id,
                    'fuel_id' => $detail['fuel_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                ]);

                $totalPrice += $detailEntryForm->price * $detailEntryForm->quantity;
            }

            $entryForm->total_price = $totalPrice;
            $entryForm->save();

            return new EntryFormResource($entryForm);
        });
    }

    public function show($id)
    {
        $entryForm = EntryForm::find($id);

        if (!$entryForm) {
            return $entryForm;
        }

        return new EntryFormResource($entryForm);
    }

    public function countData()
    {
        return [
            'countEntryForm' => EntryForm::count(),
        ];
    }
}

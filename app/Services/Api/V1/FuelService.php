<?php

namespace App\Services\Api\V1;

use App\Http\Resources\FuelResource;
use App\Models\Fuel;

class FuelService
{
    public function getList()
    {
        $fuels = Fuel::all();

        return FuelResource::collection($fuels);
    }

    public function store($request)
    {
        $fuel = Fuel::create([
            'name' => $request->name,
            'type_fuel' => $request->type_fuel,
            'price' => $request->price,
            'description' => $request->description
        ]);

        return new FuelResource($fuel);
    }

    public function show($id)
    {
        $fuel = Fuel::find($id);

        if (!$fuel) {
            return $fuel;
        }

        return new FuelResource($fuel);
    }

    public function update($request)
    {
        $fuel = Fuel::find($request->id);

        if (!$fuel) {
            return $fuel;
        }

        $fuel->name = $request->name;
        $fuel->type_fuel = $request->type_fuel;
        $fuel->price = $request->price;
        $fuel->description = $request->description;

        $fuel->save();

        return new FuelResource($fuel);
    }

    public function destroy($id)
    {
        $fuel = Fuel::find($id);

        if (!$fuel) {
            return $fuel;
        }

        $fuel->delete();

        return true;
    }

    public function countData()
    {
        return [
            'countFuel' => Fuel::count(),
        ];
    }
}
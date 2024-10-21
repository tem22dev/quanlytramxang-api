<?php

namespace App\Services\Api\V1;

use App\Http\Resources\GasStationResource;
use App\Models\GasStation;

class GasStationService
{
    public function getList()
    {
        $gasStations = GasStation::with(['user'])->get();

        return GasStationResource::collection($gasStations);
    }

    public function store($request)
    {
        $gasStation = GasStation::create([
            'user_id' => $request->user_id,
            'name_station' => $request->name_station,
            'lng' => $request->lng,
            'lat' => $request->lat,
            'image' => $request->image,
            'address' => $request->address,
        ]);

        return new GasStationResource($gasStation);
    }

    public function show($id)
    {
        $gasStation = GasStation::find($id);

        if (!$gasStation) {
            return $gasStation;
        }

        return new GasStationResource($gasStation);
    }

    public function update($request)
    {
        $gasStation = GasStation::find($request->id);

        if (!$gasStation) {
            return $gasStation;
        }

        $gasStation->user_id = $request->user_id;
        $gasStation->name_station = $request->name_station;
        $gasStation->lng = $request->lng;
        $gasStation->lat = $request->lat;
        if ($request->image) {
            $gasStation->image = $request->image;
        }
        $gasStation->address = $request->address;

        $gasStation->save();

        return new GasStationResource($gasStation);
    }

    public function destroy($id)
    {
        $gasStation = GasStation::find($id);

        if (!$gasStation) {
            return $gasStation;
        }

        $gasStation->delete();

        return true;
    }

    public function countData()
    {
        return [
            'countGasStation' => GasStation::count(),
        ];
    }

    public function search($query)
    {
        $gasStations = GasStation::where('id', $query)
            ->orWhere('name_station', 'like', '%' . $query . '%')
            ->get();

        if ($gasStations->isEmpty()) {
            return null;
        }

        return GasStationResource::collection($gasStations);
    }
}
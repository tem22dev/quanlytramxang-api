<?php

namespace App\Services\Api\V1;

use App\Http\Resources\StaffResource;
use App\Models\Staff;

class StaffService
{
    public function getList()
    {
        $staffs = Staff::with(['gasStation'])->get();

        return StaffResource::collection($staffs);
    }

    public function getListByGasStationId($id)
    {
        $staffs = Staff::where('gas_station_id', $id)->get();

        return StaffResource::collection($staffs);
    }

    public function store($request)
    {
        $staff = Staff::create([
            'gas_station_id' => $request->gas_station_id,
            'full_name' => $request->full_name,
            'tel' => $request->tel,
            'address' => $request->address,
            'birth_date' => $request->birth_date,
            'position' => $request->position,
        ]);

        return new StaffResource($staff);
    }

    public function show($id)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            return $staff;
        }

        return new StaffResource($staff);
    }

    public function update($request)
    {
        $staff = Staff::find($request->id);

        if (!$staff) {
            return $staff;
        }

        $staff->gas_station_id = $request->gas_station_id;
        $staff->full_name = $request->full_name;
        $staff->tel = $request->tel;
        $staff->address = $request->address;
        $staff->birth_date = $request->birth_date;
        $staff->position = $request->position;

        $staff->save();

        return new StaffResource($staff);
    }

    public function destroy($id)
    {
        $staff = Staff::find($id);

        if (!$staff) {
            return $staff;
        }

        $staff->delete();

        return true;
    }

    public function countData()
    {
        return [
            'countStaff' => Staff::count(),
        ];
    }
}
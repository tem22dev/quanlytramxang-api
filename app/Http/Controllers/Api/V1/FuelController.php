<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateFuelRequest;
use App\Http\Requests\Api\V1\UpdateFuelRequest;
use App\Services\Api\V1\FuelService;

class FuelController extends Controller
{
    public FuelService $fuelService;

    public function __construct(FuelService $fuelService)
    {
        $this->fuelService = $fuelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->fuelService->getList();

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFuelRequest $request)
    {
        $result = $this->fuelService->store($request);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = $this->fuelService->show($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFuelRequest $request, string $id)
    {
        $result = $this->fuelService->update($request);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->fuelService->destroy($id);

        if ($result) {
            return $this->responseMessageSuccess('Xoá nhiên liệu thành công!');
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Counter data.
     */
    public function counterFuel()
    {
        $result = $this->fuelService->countData();

        return $this->responseDataSuccess($result);
    }
}

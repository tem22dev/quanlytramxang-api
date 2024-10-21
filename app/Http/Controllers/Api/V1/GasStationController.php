<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateGasStationRequest;
use App\Http\Requests\Api\V1\UpdateGasStationRequest;
use App\Services\Api\V1\GasStationService;
use Illuminate\Http\Request;

class GasStationController extends Controller
{
    public GasStationService $gasStationService;

    public function __construct(GasStationService $gasStationService)
    {
        $this->gasStationService = $gasStationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->gasStationService->getList();

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGasStationRequest $request)
    {
        $result = $this->gasStationService->store($request);

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
        $result = $this->gasStationService->show($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGasStationRequest $request, string $id)
    {
        $result = $this->gasStationService->update($request);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->gasStationService->destroy($id);

        if ($result) {
            return $this->responseMessageSuccess();
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Count data
     */
    public function counterGasStation()
    {
        $result = $this->gasStationService->countData();

        return $this->responseDataSuccess($result);
    }

    /**
     * Search gas stations by name or ID.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        $result = $this->gasStationService->search($query);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageNotfound();
    }
}

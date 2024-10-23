<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateStaffRequest;
use App\Http\Requests\Api\V1\UpdateStaffRequest;
use App\Services\Api\V1\StaffService;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class StaffController extends Controller
{
    public StaffService $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->staffService->getList();

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateStaffRequest $request)
    {
        $result = $this->staffService->store($request);

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
        $result = $this->staffService->show($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStaffRequest $request, string $id)
    {
        $result = $this->staffService->update($request);

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
        $result = $this->staffService->destroy($id);

        if ($result) {
            return $this->responseMessageSuccess('Xoá nhân viên thành công!');
        }

        return $this->responseMessageNotfound();
    }

    /**
     * Counter data.
     */
    public function counterStaff()
    {
        $result = $this->staffService->countData();

        return $this->responseDataSuccess($result);
    }

    /**
     * Counter data.
     */
    public function getListByGasStationId($id)
    {
        $result = $this->staffService->getListByGasStationId($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }
}

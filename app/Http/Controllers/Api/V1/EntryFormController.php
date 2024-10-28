<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreateEntryFormRequest;
use App\Services\Api\V1\EntryFormService;
use Illuminate\Http\Request;

class EntryFormController extends Controller
{
    public EntryFormService $entryFormService;

    public function __construct(EntryFormService $entryFormService)
    {
        $this->entryFormService = $entryFormService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->entryFormService->getList();

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEntryFormRequest $request)
    {
        $result = $this->entryFormService->store($request);

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
        $result = $this->entryFormService->show($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function getListEntryFormByIdGasStation($id)
    {
        $result = $this->entryFormService->getListEntryFormByIdGasStation($id);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    /**
     * Counter data.
     */
    public function counterEntryForm()
    {
        $result = $this->entryFormService->countData();

        return $this->responseDataSuccess($result);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UploadFileRequest;
use App\Services\Api\V1\SiteService;

class UploadFileController extends Controller
{
    public SiteService $siteService;

    public function __construct(SiteService $siteService)
    {
        $this->siteService = $siteService;
    }

    public function upload(UploadFileRequest $request)
    {
        $result = $this->siteService->uploadImage($request);

        if ($result) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }
}

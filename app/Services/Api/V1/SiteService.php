<?php

namespace App\Services\Api\V1;

use App\Traits\ImageTrait;

class SiteService
{
    public function uploadImage($request)
    {
        if ($request->file('file')) {
            $folder = $request->topic . 's';
            $image = ImageTrait::storeImage($request->file('file'), $folder);

            return [
                'image' => $image['url'],
            ];
        }

        return false;
    }
}
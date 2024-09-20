<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\TopicFileEnum;
use App\Http\Requests\BaseRequest;

class UploadFileRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'file' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:' . config('image.map.size')],
            'topic' => ['required', 'in:' . TopicFileEnum::getValuesAsString(',')]
        ];
    }
}

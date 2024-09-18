<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;

class CreateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string'],
            'tel' => ['required', 'numeric', 'digits:10', 'unique:users,tel'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ];
    }
}

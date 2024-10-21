<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseRequest
{
    public function rules(Request $request): array
    {
        $userId = $request->route('user'); // Lấy user ID từ route parameter nếu có

        return [
            'full_name' => ['required', 'string'],
            'tel' => [
                'required',
                'numeric',
                'digits:10',
                Rule::unique('users', 'tel')->ignore($userId)
            ],
            'email' => [
                'required', 
                'email', 
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'password' => ['nullable', 'min:6'],
        ];
    }
}

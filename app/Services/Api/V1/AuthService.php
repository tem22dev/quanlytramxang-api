<?php

namespace App\Services\Api\V1;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function getUserByToken()
    {
        $user = auth('sanctum')->user();

        if ($user) {
            return [
                'status' => true,
                'data' => [
                    'user' => $user
                ],
            ];
        }

        return [
            'status' => false,
            'message' => 'Không thể lấy được thông tin user.',
        ];
    }

    public function login($request)
    {
        $user = User::where('email', $request['user_identifier'])
            ->orWhere('tel', $request['user_identifier'])->first();
        $allowUser = [
            UserTypeEnum::ROOT_ADMIN->value,
            UserTypeEnum::MEMBER_ADMIN->value,
        ];

        if ($user && in_array($user->user_type, $allowUser)) {
            if (Hash::check($request['password'], $user['password'])) {
                $token = $user->createToken(env('AUTH_TOKEN'))->plainTextToken;
                return [
                    'status' => true,
                    'data' => [
                        'user' => $user,
                        'token' => $token,
                    ]
                ];
            }
        }

        return [
            'status' => false,
            'message' => __('messages.wrong_login_id_or_password'),
        ];
    }
}
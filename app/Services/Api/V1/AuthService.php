<?php

namespace App\Services\Api\V1;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
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
                $token = $user->createToken(
                    name: env('AUTH_TOKEN'),
                    expiresAt: $request['remember_me'] ? now()->addDays(7) : now()->addHour()
                )->plainTextToken;
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
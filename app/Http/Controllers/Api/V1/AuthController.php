<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Services\Api\V1\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getUserByToken()
    {
        $result = $this->authService->getUserByToken();

        if ($result && $result['status'] === true) {
            return $this->responseDataSuccess($result['data']);
        }

        return $this->responseMessageBadrequest($result['message']);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request);

        if ($result && $result['status'] === true) {
            return $this->responseDataSuccess($result['data']);
        }

        return $this->responseMessageBadrequest($result['message']);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user) {
            $user->currentAccessToken()->delete();

            return $this->responseMessageSuccess('Logout successful');
        }

        return $this->responseMessageBadrequest();
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Services\Api\V1\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->login($request);

        if ($result && $result['status'] === true) {
            return $this->responseDataSuccess($result['data']);
        }

        return $this->responseMessageUnAuthorization($result['message']);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        
        if ($user) {
            $request->user()->currentAccessToken()->delete();

            return $this->responseMessageSuccess('Logout successful');
        }

        return $this->responseMessageBadrequest();
    }
}

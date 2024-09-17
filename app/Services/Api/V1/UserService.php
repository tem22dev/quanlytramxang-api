<?php

namespace App\Services\Api\V1;

use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function countData()
    {
        return [
            'countAccount' => User::count()
        ];
    }
}
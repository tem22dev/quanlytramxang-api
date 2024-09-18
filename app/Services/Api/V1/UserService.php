<?php

namespace App\Services\Api\V1;

use App\Enums\UserTypeEnum;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getList() {
        $users = User::where('user_type', '!=', UserTypeEnum::ROOT_ADMIN->value)->get();

        return UserResource::collection($users);
    }

    public function store($request)
    {
        $password = Hash::make($request->password);

        $user = User::create([
            'full_name' => $request->full_name,
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => $password,
            'user_type' => UserTypeEnum::MEMBER_ADMIN->value,
        ]);

        return new UserResource($user);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $user;
        }

        return new UserResource($user);
    }

    public function update($request)
    {
        $user = User::find($request->id);

        if (!$user) {
            return $user;
        }

        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->tel = $request->tel;
        if ($request->password) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }

        $user->save();

        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $user;
        }

        $user->delete();

        return true;
    }

    public function countData()
    {
        return [
            'countAccount' => User::count()
        ];
    }
}
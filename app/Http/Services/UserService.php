<?php

namespace App\Http\Services;

use App\Http\Resources\UserInfoResource;

class UserService
{
    /**
     * @return UserInfoResource
     */
    public function info(): UserInfoResource
    {
        $user = request()->user()->load(['notifications', 'tasks']);
        return UserInfoResource::make($user);
    }
}

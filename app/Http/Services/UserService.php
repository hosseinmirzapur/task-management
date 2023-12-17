<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Resources\UserInfoResource;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

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

    public function update(string $username): Authenticatable | User
    {
        $user = auth()->user();
        $user->update([
            'username'  => $username,
        ]);

        return $user;
    }

    /**
     * @param $old
     * @param $new
     * @return void
     * @throws CustomException
     */
    public function changePass($old, $new): void
    {
        $user = auth()->user();

        if (!Hash::check($old, $user->password)) {
            throw new CustomException('wrong old password');
        }

        $user->update([
            'password' => Hash::make($new)
        ]);

    }
}

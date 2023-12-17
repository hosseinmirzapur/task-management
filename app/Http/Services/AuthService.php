<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @return array{token: string}
     * @throws CustomException
     */
    public function login(string $username, string $password): array
    {
        $user = User::query()->where('username', $username)->first();
        if (!$user) {
            throw new CustomException('invalid username/password');
        }

        if (!Hash::check($password, $user->password)) {
            throw new CustomException('invalid username/password');
        }

        return [
            'token' => $user->generateToken()
        ];
    }

    /**@return array{token: string}
     * @throws CustomException
     */
    public function register(string $username, string $password): array
    {
        $user = User::query()->create([
            'username' => $username,
            'password' => Hash::make($password)
        ]);

        return [
            'token' => $user->generateToken()
        ];
    }

    public function logout(): void
    {
        request()->user()->tokens()->delete();
    }
}

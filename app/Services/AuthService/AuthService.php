<?php

namespace App\Services\AuthService;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    public function register(RegisterDTO $dto): User
    {
        $user = User::query()->create($dto->toArray());

        return $user;
    }

    public function login(LoginDTO $dto): array
    {
        if (! $access_token = JWTAuth::attempt($dto->toArray())) {
            throw new \Error("Invalid Credentials");
        }
        $user = auth()->user();

        $refresh_token = hash('sha256', Str::uuid());

        $user->update([
            "refresh_token" => $refresh_token,
            'refresh_token_expires_at' => now()->addDays(14),
        ]);

        return [
            "access_token" => $access_token,
            "refresh_token" => $refresh_token,
        ];
    }
}

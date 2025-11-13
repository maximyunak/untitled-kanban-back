<?php

namespace App\Services\AuthService;

use App\DTOs\Auth\RegisterDTO;
use App\Models\User;

class AuthService
{
    public function register(RegisterDTO $dto): User
    {
        $user = User::query()->create($dto->toArray());

        return $user;
    }
}

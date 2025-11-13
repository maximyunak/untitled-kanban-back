<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Services\AuthService\AuthService;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegisterRequest $request)
    {

    }
}

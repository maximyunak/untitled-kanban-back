<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = new RegisterDto(...$request->validated());

        $user = $this->authService->register($dto);

        return $this->success(code: 201, message: "Registration successful", data: $user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = new LoginDto(...$request->validated());

        $tokens = $this->authService->login($dto);

        return $this->success( message: "Login successful")
            ->withCookie(cookie("access_token", $tokens["access_token"], 60, "/"))
            ->withCookie(cookie("refresh_token", $tokens["refresh_token"], 20160, "/"));
    }

}

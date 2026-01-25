<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = new RegisterDto(...$request->validated());

        $user = $this->authService->register($dto);

        return $this->success(code: 201, message: 'Registration successful', data: $user);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = new LoginDto(...$request->validated());

        $tokens = $this->authService->login($dto);

        // return $this->success(message: 'Login successful')
        //     ->withCookie(cookie('access_token', $tokens['access_token'], 60, '/'))
        //     ->withCookie(cookie('refresh_token', $tokens['refresh_token'], 20160, '/'));

        return response()->json('', 200)
            ->withCookie(cookie('access_token', $tokens['access_token'], 60, '/'))
            ->withCookie(cookie('refresh_token', $tokens['refresh_token'], 43200, '/'));
    }

    public function logout(): JsonResponse
    {
        auth()->user()->update(['refresh_token' => null, 'refresh_token_expires_at' => null]);

        return $this->success(code: 200, message: 'Logout successful')
            ->withCookie(Cookie::forget('access_token'))
            ->withCookie(Cookie::forget('refresh_token'));
    }

    public function refresh(Request $request): JsonResponse
    {
        $refresh_token = $request->cookie('refresh_token');
        $access_token = $this->authService->refresh($refresh_token);

        return $this->success(message: 'Token updated')
            ->withCookie(cookie('access_token', $access_token, 60));
    }
}

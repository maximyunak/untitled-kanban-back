<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd($request->cookie('access_token'));
        $access_token = $request->cookie('access_token');

        try {
            $user = JWTAuth::setToken($access_token)->authenticate();
            if (! $user) {
                throw new UnauthorizedHttpException('Invalid token');
            }
        } catch (JWTException $e) {
            throw new UnauthorizedHttpException('Invalid token');
        }

        auth()->login($user);

        return $next($request);
    }
}

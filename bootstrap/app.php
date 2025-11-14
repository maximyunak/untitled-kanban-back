<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            $trait = new class {
                use \App\Http\Traits\ResponseTrait;
            };

            // Валидационные ошибки
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return $trait->errors(
                    422,
                    'Validation failed',
                    $e->errors()
                );
            }

            // 404 Not Found
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return $trait->errors(
                    404,
                    'Resource not found'
                );
            }

            if ($e instanceof  UnauthorizedHttpException) {
                return $trait->errors(
                    code: 401,
                    message: "Invalid credentials"
                );
            }

            // Все остальные ошибки
            return $trait->errors(
                500,
                'Server error',
                ['exception' => $e->getMessage()]
            );
        });
        //
    })->create();

<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Kanban\BoardController;
use App\Http\Controllers\Kanban\ColumnController;
use App\Http\Controllers\Kanban\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class, 'refresh']);

Route::middleware([CheckToken::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', [UserController::class, 'me']);

    Route::group(['prefix' => 'boards'], function () {
        Route::post('/', [BoardController::class, 'store']);
        Route::get('/', [BoardController::class, 'index']);
        Route::get('/{board}', [BoardController::class, 'show']);
        Route::delete('/{board}', [BoardController::class, 'destroy']);
        Route::patch('/{board}', [BoardController::class, 'update']);

        Route::group(['prefix' => '{board}/tasks'], function () {
            Route::patch('/move', [TaskController::class, 'move']);
            Route::patch('/{task}', [TaskController::class, 'edit']);
        });

        Route::group(['prefix' => '/{board}/columns'], function () {
            Route::get('/', [ColumnController::class, 'index']);
            Route::post('/', [ColumnController::class, 'store']);
            Route::patch('/move', [ColumnController::class, 'move']);

            Route::group(['prefix' => '/{column}/tasks'], function () {
                Route::post('/', [TaskController::class, 'store']);
            });
        });
    });
});

Route::get('/', function () {
    return 'aaa';
});

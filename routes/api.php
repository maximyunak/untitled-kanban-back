<?php

use \App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Kanban\BoardController;
use App\Http\Middleware\CheckToken;
use Illuminate\Support\Facades\Route;

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/refresh", [AuthController::class, "refresh"]);

Route::middleware([CheckToken::class])->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);

    Route::group(["prefix"=>"boards"], function () {
        Route::post("/", [BoardController::class, "store"]);
        Route::get("/", [BoardController::class, "index"]);
    });
});


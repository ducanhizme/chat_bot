<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserOrCustomerToken;
use App\Http\Controllers\Api\Auth\CustomerAuthController;

Route::middleware('auth:api') ->prefix('auth/user')->group(function () {
    Route::get('profile', [UserAuthController::class, 'profile']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh',[UserAuthController::class, 'refresh']);
});
Route::middleware('auth:customer') ->prefix('auth/customer')->group(function () {
    Route::get('profile', [CustomerAuthController::class, 'profile']);
    Route::post('logout', [CustomerAuthController::class, 'logout']);
    Route::post('refresh',[CustomerAuthController::class, 'refresh']);
});

Route::prefix('auth/user')->group(function () {
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('register', [UserAuthController::class, 'register']);
});
Route::prefix('auth/customer')->group(function () {
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::post('register', [CustomerAuthController::class, 'register']);
});

Route::apiResource('todos', \App\Http\Controllers\TodoController::class);


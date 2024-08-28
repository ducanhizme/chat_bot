<?php

use App\Http\Controllers\Api\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserOrCustomerToken;
use App\Http\Controllers\Api\Auth\CustomerAuthController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::middleware(['auth:api',CheckUserOrCustomerToken::class.':user']) ->prefix('auth/user')->group(function () {
    Route::get('profile', [UserAuthController::class, 'profile']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh',[UserAuthController::class, 'refresh']);
});
Route::middleware(['auth:customer',CheckUserOrCustomerToken::class.':customer']) ->prefix('auth/customer')->group(function () {
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


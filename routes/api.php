<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API-маршруты
|--------------------------------------------------------------------------
|
| Возвращает данные текущего аутентифицированного пользователя.
|
|--------------------------------------------------------------------------
*/
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {

        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('login-via-token', 'loginViaToken');

        Route::middleware('auth:sanctum')
            ->group(function () {
                Route::post('loginViaToken', 'refresh')
                    ->name('refresh');
            });
    });

Route::middleware("auth:sanctum")
    ->group(function () {
        Route::controller(\App\Http\Controllers\Api\UserController::class)
            ->group(function () {
                Route::get("auth/me", 'me');
                Route::get("auth/me/all", 'meAll');
            });
    });

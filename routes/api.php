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
        Route::post('loginViaToken', 'loginViaToken');

    });

Route::middleware("auth:sanctum")
    ->group(function () {
        Route::controller(\App\Http\Controllers\Api\UserController::class)
            ->group(function () {
                Route::get("auth/me", 'me');
                Route::get("auth/me/all", 'meAll');
            });

        Route::controller(\App\Http\Controllers\Api\FeedbackController::class)
            ->prefix("feedback")
            ->group(function () {
                Route::post("", 'store');
                Route::put("update", 'update');
                Route::delete("{feedback}", 'destroy');
            });

        Route::controller(\App\Http\Controllers\Api\RoleController::class)
            ->prefix("role")
            ->group(function () {
                Route::get("all", 'getAll');
                Route::get("{role}", 'getById');
            });

        Route::controller(\App\Http\Controllers\Api\StatusProductController::class)
            ->prefix("StatusProduct")
            ->group(function () {
                Route::get("all", 'getAll');
                Route::get("{statusProduct}", 'getById');
            });

        Route::controller(\App\Http\Controllers\Api\StatusOrderController::class)
            ->prefix("StatusOrder")
            ->group(function () {
                Route::get("all", 'getAll');
                Route::get("{statusOrder}", 'getById');
            });

        Route::controller(\App\Http\Controllers\Api\FavouriteController::class)
            ->prefix("selectedProducts")
            ->group(function () {
                Route::get("all", 'getAll');
                Route::post("", 'store');
                Route::delete("{favourite}", 'destroy');
            });
    });

Route::controller(\App\Http\Controllers\Api\FeedbackController::class)
    ->group(function () {
        Route::prefix('feedback')
            ->group(function () {
                Route::get("all", 'getAll');
                Route::get("{feedback}", 'getById');
            });

    });

Route::controller(\App\Http\Controllers\Api\ProductController::class)
    ->prefix('product')
    ->group(function () {
        Route::get("all/publish", 'getAllPublish');
        Route::get("all/editing", 'getAllEditing');
        Route::get("byYpk/{ypk}", 'getByYpk');
        Route::get("{product}", 'getById');

        Route::middleware("auth:sanctum")
            ->group(function () {
                Route::post("", 'store');
                Route::put("update", 'update');
                Route::delete("{product}", 'destroy');
            });
    });

Route::controller(\App\Http\Controllers\Api\OrderController::class)
    ->prefix('order')
    ->group(function () {
        Route::get("all", 'getAll');
        Route::get("{order}", 'getById');

        Route::middleware("auth:sanctum")
            ->group(function () {
                Route::post("", 'store');
            });

        Route::middleware(['auth:sanctum', 'manager'])
            ->group(function () {
                Route::get("manager", 'getAllForManager');
                Route::delete("{order}", 'destroy');
            });
    });

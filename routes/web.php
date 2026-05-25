<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YpkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Главная страница
|--------------------------------------------------------------------------
|
| Доступна всем пользователям без авторизации.
|
|--------------------------------------------------------------------------
*/
Route::controller(\App\Http\Controllers\MainController::class)
    ->group(function () {
        Route::get("/", 'index')->name("main");
    });

/*
|--------------------------------------------------------------------------
| Маршруты для авторизованных пользователей
|--------------------------------------------------------------------------
|
| Личный кабинет, редактирование профиля. Требуют аутентификации.
|
|--------------------------------------------------------------------------
*/
Route::middleware("auth")
    ->group(function () {
        /*
         * Профиль текущего пользователя
         */
        Route::controller(\App\Http\Controllers\CurrentUserController::class)
            ->group(function () {
                Route::get('/home', 'index')->name('home');
                Route::prefix('user')
                    ->group(function () {
                        Route::get("/edit", 'edit')->name('user_edit');
                        Route::put("/update", 'update')->name('user_edit.update');
                    });
            });

        /*
         * Административные маршруты (только для администраторов)
         */
        Route::middleware('admin')
            ->group(function () {
                /*
                 * Управление категориями товаров/услуг
                 */
                Route::controller(YpkController::class)
                    ->prefix('ypk')
                    ->name('ypk')
                    ->group(function () {
                        Route::post('', 'store')->name('.store');
                        Route::delete('', 'destroy')->name('.destroy');
                    });

                /*
                 * Управление товарами и услугами
                 */
                Route::controller(ProductController::class)
                    ->prefix('product')
                    ->name('product')
                    ->group(function () {
                        Route::get('', 'index')->name('.index');
                        Route::get('create', 'create')->name('.create');
                        Route::post('', 'store')->name('.store');
                        Route::get('/edit_page', 'edit_page')->name('.edit_page');
                        Route::get('{product}', 'show')->name('.show');
                        Route::get('{product}/edit', 'edit')->name('.edit');
                        Route::put('{product}', 'update')->name('.update');
                        Route::delete('{product}', 'destroy')->name('.destroy');
                    });

                /*
                 * Управление пользователями
                 */
                Route::controller(UserController::class)
                    ->prefix('user_management')
                    ->name('user_management')
                    ->group(function () {
                        Route::get('', 'index')->name('.index');
                        Route::get('create', 'create')->name('.create');
                        Route::post('', 'store')->name('.store');
                        Route::get('{user}/edit', 'edit')->name('.edit');
                        Route::put('{user}', 'update')->name('.update');
                        Route::delete('{user}', 'destroy')->name('.destroy');
                    });
            });
    });

<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\YpkController;
use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\MainController::class)
    ->group(function () {
        Route::get("/", 'index')->name("main");
    });

Route::middleware("auth")
    ->group(function () {
        Route::controller(\App\Http\Controllers\CurrentUserController::class)
            ->group(function () {
                Route::get('/home', 'index')->name('home');
                Route::prefix('user')
                    ->group(function () {
                        Route::get("/edit", 'edit')->name('user_edit');
                        Route::put("/update", 'update')->name('user_edit.update');
                    });
            });

        Route::controller(\App\Http\Controllers\FavouriteController::class)
            ->prefix("favourite")
            ->name("favourite")
            ->group(function () {
                Route::get('', 'index')->name('.index');
                Route::post('', 'store')->name('.store');
                Route::delete("{product}", 'destroy')->name('.destroy');
            });

        Route::middleware('admin')
            ->group(function () {
                Route::controller(YpkController::class)
                    ->prefix('ypk')
                    ->name('ypk')
                    ->group(function () {
                        Route::post('', 'store')->name('.store');
                        Route::delete('', 'destroy')->name('.destroy');
                    });

                Route::controller(ProductController::class)
                    ->prefix('product')
                    ->name('product')
                    ->group(function () {
                        Route::get('', 'index')->name('.index');
                        Route::get('create', 'create')->name('.create');
                        Route::post('', 'store')->name('.store');
                        Route::get('/edit_page', 'edit_page')->name('.edit_page');
                        Route::get('{product}/edit', 'edit')->name('.edit');
                        Route::put('{product}', 'update')->name('.update');
                        Route::delete('{product}', 'destroy')->name('.destroy');
                    });

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

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show')->whereUuid('product');
Route::view('about_us', 'about_us')->name('about_us');

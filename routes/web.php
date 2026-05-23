<?php

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

        Route::middleware('admin')
        ->group(function() {
            Route::controller(YpkController::class)
            ->prefix('ypk')
            ->name('ypk')
            ->group(function () {
                Route::post('', 'store')->name('.store');
                Route::delete('', 'destroy')->name('.destroy');
            });
        });
    });

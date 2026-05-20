<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\MainController::class)
    ->group(function () {
        Route::get("/", 'index')->name("main");
    });

<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Консольные команды
|--------------------------------------------------------------------------
|
| Команда для отображения вдохновляющей цитаты.
|
|--------------------------------------------------------------------------
*/
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Показать вдохновляющую цитату');


Schedule::call(function (Schedule $schedule) {
   Artisan::call("sitemap:generate");
})->daily()->name("Generate sitemap");

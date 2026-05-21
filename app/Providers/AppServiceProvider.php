<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        \Blade::directive('isAdmin', function () {
            return "<?php if(auth()->check() && auth()->user()->isAdmin()): ?>";
        });

        \Blade::directive('endisAdmin', function () {
            return "<?php endif; ?>";
        });

        \Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });
    }
}

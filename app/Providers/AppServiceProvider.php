<?php

namespace App\Providers;

use App\Contracts\IImageService;
use App\Models\User;
use App\Services\ImageService;
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
        $this->app->scoped(IImageService::class, ImageService::class);
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

<?php

namespace App\Providers;

use App\Contracts\IImageService;
use App\Contracts\Repository\IOrderRepository;
use App\Contracts\Repository\IProductRepository;
use App\Enums\TokenAbility;
use App\Models\User;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Services\ImageService;
use Illuminate\Database\Schema\Builder;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped(IImageService::class, ImageService::class);
        $this->app->singleton(IProductRepository::class, ProductRepository::class);
        $this->app->singleton(IOrderRepository::class, OrderRepository::class);
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

        $this->overrideSanctumConfigurationToSupportRefreshToken();

        Builder::$defaultMorphKeyType = "uuid";

        JsonResource::withoutWrapping();
    }

    private function overrideSanctumConfigurationToSupportRefreshToken(): void
    {
        Sanctum::$accessTokenAuthenticationCallback = function ($accessToken, $isValid) {
            $abilities = collect($accessToken->abilities);
            if (!empty($abilities) && $abilities[0] === TokenAbility::ISSUE_ACCESS_TOKEN->value) {
                return $accessToken->expires_at && $accessToken->expires_at->isFuture();
            }

            return $isValid;
        };

        Sanctum::$accessTokenRetrievalCallback = function ($request) {
            if (!$request->routeIs('refresh')) {
                return str_replace('Bearer ', '', $request->headers->get('Authorization'));
            }

            return $request->cookie('refreshToken') ?? '';
        };
    }
}

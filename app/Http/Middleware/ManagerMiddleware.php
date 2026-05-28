<?php

namespace App\Http\Middleware;

use App\Enums\RoleName;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $current_user = $request->user();

        if ($current_user->role?->role_name !== RoleName::Admin->value
            && $current_user->role?->role_name !== RoleName::Manager->value) {
            abort(403);
        }

        return $next($request);
    }
}

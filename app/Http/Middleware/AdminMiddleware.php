<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $current_user = $request->user();
        if ($current_user->role?->role_name === \App\Enums\RoleName::Admin->value) {
            abort(403);
        }
        return $next($request);
    }
}

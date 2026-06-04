<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $current_user = $request->user();

        if ($current_user->role_id != 1
            && $current_user->role_id != 2) {
            abort(403);
        }

        return $next($request);
    }
}

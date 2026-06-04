<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Проверить, что текущий пользователь является администратором.
     *
     * Если роль пользователя не соответствует Admin — возвращает 403.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $current_user = $request->user();

        if ($current_user->role_id != 1) {
            abort(403);
        }

        return $next($request);
    }
}

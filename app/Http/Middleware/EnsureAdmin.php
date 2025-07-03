<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth('admin')->check() ? auth('admin')->user() : auth()->user();

        if (!$user || !$user->is_admin) {
            abort(403, 'Unauthorized: You are not admin.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            abort(403, 'No autorizado.');
        }

        if (! auth()->user()->isAdmin()) {
            abort(403, 'Acceso permitido solo para administradores.');
        }

        return $next($request);
    }
}
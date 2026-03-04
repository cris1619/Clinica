<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->roles->first();

        if (!$userRole || $userRole->nombre !== $role) {
            abort(403, 'No tienes permiso para acceder aquí');
        }

        return $next($request);
    }
}
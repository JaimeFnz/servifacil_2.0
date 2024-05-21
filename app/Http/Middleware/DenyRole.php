<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Gate::denies($role)) {
            abort(403);
        }

        return $next($request);
    }
}

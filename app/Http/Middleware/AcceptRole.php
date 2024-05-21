<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class CheckSingleRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Gate::allows($role)) {
            abort(403);
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class checkRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        if($request->user()->checkRole($roles))
        {
            return $next($request);
        }
        abort(401);
    }
}

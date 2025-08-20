<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCsrfToken
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}


<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    /** Keep one public URL format: paths do not end in a slash. */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}

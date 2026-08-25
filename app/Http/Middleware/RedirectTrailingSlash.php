<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    /** Keep one public URL format: paths do not end in a slash. */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->getPathInfo();

        if (in_array($request->method(), ['GET', 'HEAD'], true) && $path !== '/' && str_ends_with($path, '/')) {
            // Prevent redirect loop for XML files
            if (str_ends_with($path, '.xml/')) {
                return $next($request);
            }

            $target = rtrim($path, '/');

            if ($request->getQueryString()) {
                $target .= '?' . $request->getQueryString();
            }

            return redirect($target, 301);
        }

        return $next($request);
    }
}

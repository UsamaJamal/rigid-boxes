<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    /** Keep one public URL format: paths do not end in a slash. */
    public function handle(Request $request, Closure $next)
    {
        $path = parse_url($request->getRequestUri(), PHP_URL_PATH) ?: '/';

        if (in_array($request->method(), ['GET', 'HEAD'], true) && $path !== '/' && substr($path, -1) === '/') {
            $target = rtrim($path, '/');

            if ($request->getQueryString()) {
                $target .= '?' . $request->getQueryString();
            }

            return redirect($target, 301);
        }

        return $next($request);
    }
}

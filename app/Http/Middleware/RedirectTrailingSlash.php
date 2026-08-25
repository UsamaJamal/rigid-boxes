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

        if (!in_array($request->method(), ['GET', 'HEAD'], true)) {
            return $next($request);
        }

        // Case 1: If URL ends with a slash, check if we should REMOVE it (e.g. for XML files)
        if (str_ends_with($path, '/')) {
            $trimmed = rtrim($path, '/');
            if (str_ends_with($trimmed, '.xml')) {
                $target = $trimmed;
                if ($request->getQueryString()) {
                    $target .= '?' . $request->getQueryString();
                }
                return redirect($target, 301);
            }
        }
        // Case 2: If URL does NOT end with a slash, check if we should ADD it
        else {
            // Add trailing slash to all pages except the homepage and paths with file extensions (like .xml, .png, etc.)
            if ($path !== '/' && !preg_match('/\.[a-zA-Z0-9]+$/', $path)) {
                $target = $path . '/';
                if ($request->getQueryString()) {
                    $target .= '?' . $request->getQueryString();
                }
                return redirect($target, 301);
            }
        }

        return $next($request);
    }
}

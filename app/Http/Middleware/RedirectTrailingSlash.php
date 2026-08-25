<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectTrailingSlash
{
    /** Keep one public URL format: pages end in '/', sitemap.xml does not. */
    public function handle(Request $request, Closure $next)
    {
        $path = parse_url($request->getRequestUri(), PHP_URL_PATH) ?: '/';

        if (!in_array($request->method(), ['GET', 'HEAD'], true) || $path === '/') {
            return $next($request);
        }

        $normalizedPath = rtrim($path, '/');
        $isSitemapXml = strtolower($normalizedPath) === '/sitemap.xml';
        $hasFileExtension = pathinfo($normalizedPath, PATHINFO_EXTENSION) !== '';
        $isSystemPath = preg_match('#^/(?:admin|api|sanctum)(?:/|$)|^/submit-#i', $normalizedPath);
        $target = null;

        if ($isSitemapXml && substr($path, -1) === '/') {
            $target = $normalizedPath;
        } elseif (!$isSitemapXml && !$hasFileExtension && !$isSystemPath && substr($path, -1) !== '/') {
            $target = $path . '/';
        }

        if ($target !== null) {

            if ($request->getQueryString()) {
                $target .= '?' . $request->getQueryString();
            }

            // Laravel's URL generator trims trailing slashes. A raw Location
            // header preserves the canonical slash exactly as intended.
            return response('', 301)->header('Location', $target);
        }

        return $next($request);
    }
}

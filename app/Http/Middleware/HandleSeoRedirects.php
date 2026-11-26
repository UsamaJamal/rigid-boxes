<?php

namespace App\Http\Middleware;

use App\Support\RedirectManager;
use Closure;
use Illuminate\Http\Request;

class HandleSeoRedirects
{
    public function handle(Request $request, Closure $next)
    {
        $match = RedirectManager::matchRequest($request);

        if ($match === null) {
            return $next($request);
        }

        RedirectManager::recordHit($match['id'] ?? null);

        $statusCode = (int) ($match['status_code'] ?? 301);
        $location = $match['location'] ?? null;

        if ($statusCode === 410) {
            return response()
                ->view('errors.410', [], 410)
                ->header('X-Robots-Tag', 'noindex, nofollow');
        }

        if ($statusCode === 404 || $location === null) {
            abort(404);
        }

        $response = response('', $statusCode)->header('Location', $location);

        if (in_array($statusCode, [302, 307], true)) {
            $response->header('Cache-Control', 'no-store, no-cache, must-revalidate');
        }

        return $response;
    }
}

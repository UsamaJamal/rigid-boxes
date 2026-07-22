<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() && !session('admin_logged_in')) {
            return redirect()->route('admin.login')->with('error', 'Please log in to access the admin portal.');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return RedirectResponse|Closure
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $currentRoute = (object) $request->route();
        $currentRouteName = $currentRoute->getName();
        if (str_starts_with($currentRouteName, 'password')) {
            return $next($request);
        }

        if (Auth::guard($guard)->check()) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}

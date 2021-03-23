<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next, string $guard = null)
    {
        if (\Auth::guard($guard)->check()) {
            if (\Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('home');
        }

        return $next($request);
    }
}

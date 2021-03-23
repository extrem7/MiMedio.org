<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class DebugBarMiddleware
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        if (!\Auth::check() || !\Auth::user()->is_admin) {
            \Debugbar::disable();
        }
        return $next($request);
    }
}

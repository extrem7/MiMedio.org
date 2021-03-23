<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (\Auth::check() && \Auth::user()->is_admin) {
            return $next($request);
        }
        abort(503);
    }
}

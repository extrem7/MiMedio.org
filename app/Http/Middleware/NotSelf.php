<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
use Illuminate\Http\Request;

class NotSelf
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::id() === $request->route()->parameter('user')->id) {
            abort(400);
            exit;
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class NotSelf
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        if (\Auth::id() === $request->route()->parameter('user')->id) {
            abort(400);
            exit;
        }
        return $next($request);
    }
}

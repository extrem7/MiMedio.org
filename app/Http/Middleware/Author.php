<?php

namespace App\Http\Middleware;

use Closure;
use \Auth;
use Illuminate\Http\Request;

class Author
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
        if ($request->routeIs(['posts.edit', 'posts.update', 'posts.delete'])) {
            if (Auth::id() !== $request->route()->parameter('post')->author->id) {
                abort(403);
                exit;
            }
        }
        return $next($request);
    }
}

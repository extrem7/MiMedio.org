<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class Author
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        if ($request->routeIs(['posts.edit', 'posts.update', 'posts.destroy'])) {
            $post = $request->route()->parameter('post');
            if (\Auth::id() !== $post->author->id) {
                abort(403);
            }
        }
        return $next($request);
    }
}

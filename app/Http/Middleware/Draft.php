<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Auth;
use Closure;

class Draft
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post = $request->route()->parameter('post');
        if ($post->status !== Post::PUBLISHED) {
            if (!Auth::check() || Auth::id() !== $post->author->id) {
                abort(403);
            }
        }
        return $next($request);
    }
}

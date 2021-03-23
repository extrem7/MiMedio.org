<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Illuminate\Http\Request;

class Draft
{
    /**
     * @param Request $request
     */
    public function handle($request, \Closure $next)
    {
        $post = $request->route()->parameter('post');
        if ($post->status !== Post::PUBLISHED) {
            if (!\Auth::check() || \Auth::id() !== $post->author->id) {
                abort(403);
            }
        }
        return $next($request);
    }
}

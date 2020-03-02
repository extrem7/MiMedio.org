<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use \Auth;
use Illuminate\Http\Request;

class Published
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
        $post = $request->route()->parameter('post');
        if ($post->status !== Post::PUBLISHED) {
            if (!Auth::check() || Auth::id() !== $post->author->id) {
                abort(403);
            }
        }
        return $next($request);
    }
}

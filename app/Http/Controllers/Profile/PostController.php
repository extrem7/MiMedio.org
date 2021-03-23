<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    private PostsService $postsService;

    public function __construct()
    {
        parent::__construct();

        $this->postsService = app(PostsService::class);
    }

    /* @return View|LengthAwarePaginator */
    public function index()
    {
        $posts = $this->postsService->getPosts(\Auth::user()->posts());

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle('My posts');

        share(compact('posts'));

        return view('profile.posts', compact('posts'));
    }
}

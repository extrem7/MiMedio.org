<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Auth;

class PostController extends Controller
{
    private $postsService;

    public function __construct()
    {
        parent::__construct();
        $this->postsService = new PostsService();
    }

    public function index()
    {
        $user = Auth::getUser();

        $posts = $this->postsService->getPosts($user->posts());

        if (request()->expectsJson()) return $posts;

        $this->meta->prependTitle('My posts');

        share([
            'posts' => $posts
        ]);

        return view('profile.posts', compact('posts'));
    }
}

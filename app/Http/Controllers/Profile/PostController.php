<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\PostsService;
use Auth;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class PostController extends Controller
{
    private $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }

    public function index()
    {
        $this->meta->prependTitle('My posts');

        $user = Auth::getUser();

        $posts = $this->postsService->getPosts($user->posts());

        return view('profile.posts', compact('posts'));
    }
}

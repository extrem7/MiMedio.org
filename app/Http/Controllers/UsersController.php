<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Services\PostsService;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }

    public function show(User $user)
    {
        $this->meta->prependTitle($user->name);

        $posts = $this->postsService->getPosts($user->posts());

        $categoriesWithPosts = $this->postsService->getUserCategories($user);

        $playlist = $user->playlist;

        return view('users.show', compact('user', 'posts', 'categoriesWithPosts', 'playlist'));
    }

    public function posts(User $user, int $page = 1)
    {
        $posts = $this->postsService->getPosts($user->posts(), $page);
        return $posts;
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PostsService;
use Auth;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class UsersController extends Controller
{
    private $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }

    public function index(int $page = 1)
    {
        $this->meta->prependTitle('Channels');

        $user = Auth::user();
        $users = User::withCount(['posts', 'followers', 'shares'])
            ->with('avatarImage', 'logoImage', 'likesRaw')
            ->orderBy('followers_count', 'desc')
            ->paginateUri($this->postsService->perPage(), $page);

        return view('users.index', compact('user', 'users'));
    }

    public function show(User $user)
    {
        $user->loadCount('followers');

        $this->meta->prependTitle($user->name);

        $posts = $this->postsService->getPosts($user->posts());

        $shared = $this->postsService->getShared($user);

        $categoriesWithPosts = $this->postsService->getUserCategories($user);

        return view('users.show', compact('user', 'posts', 'shared', 'categoriesWithPosts'));
    }
}

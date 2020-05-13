<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Posts\BaseController as Controller;
use App\Models\User;

class PostController extends Controller
{
    public function __invoke(User $user, int $page = 1)
    {
        $posts = $this->postsService->getPosts($user->posts());
        return $posts;
    }
}

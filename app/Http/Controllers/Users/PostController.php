<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Posts\BaseController as Controller;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function __invoke(User $user, int $page = 1): LengthAwarePaginator
    {
        return $this->postsService->getPosts($user->posts());
    }
}

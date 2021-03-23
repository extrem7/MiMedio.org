<?php

namespace App\Http\Controllers\Posts;

use App\Models\Category;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;

class CategoriesController extends BaseController
{
    /* @return View|LengthAwarePaginator */
    public function show(Category $category, int $page = 1)
    {
        $posts = $this->postsService->getPosts($category->posts());

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle($category->name);

        $categories = $this->postsService->getCategories();

        share(compact('posts'));

        return view('posts.index', compact('categories', 'category'));
    }

    /* @return View|LengthAwarePaginator */
    public function userCategory(User $user, Category $category, int $page = 1)
    {
        $posts = $this->postsService->getPosts($user->posts()->where('category_id', '=', $category->id));

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle($user->name . ' | ' . $category->name);

        $user->loadCount('followers');

        $categoriesWithPosts = $this->postsService->getUserCategories($user);

        share(compact('posts'));

        return view('users.category', compact('user', 'category', 'posts', 'categoriesWithPosts'));
    }
}

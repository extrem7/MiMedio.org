<?php

namespace App\Http\Controllers\Posts;

use App\Models\Category;
use App\Models\User;

class CategoriesController extends BaseController
{
    public function show(Category $category, int $page = 1)
    {
        $posts = $this->postsService->getPosts($category->posts());

        if (request()->expectsJson()) return $posts;

        $this->meta->prependTitle($category->name);

        $categories = $this->postsService->getCategories();

        share(compact('posts'));

        return view('posts.index', compact('categories', 'category'));
    }

    public function userCategory(User $user, Category $category, int $page = 1)
    {
        $posts = $this->postsService->getPosts($user->posts()->whereCategoryId($category->id));

        if (request()->expectsJson()) return $posts;

        $this->meta->prependTitle($user->name . ' | ' . $category->name);

        $user->loadCount('followers');

        $categoriesWithPosts = $this->postsService->getUserCategories($user, false);

        share(compact('posts'));

        return view('users.category', compact('user', 'category', 'posts', 'categoriesWithPosts'));
    }
}

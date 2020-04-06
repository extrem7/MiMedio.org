<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\PostsBaseController;
use App\Models\Category;
use App\Models\User;

class CategoriesController extends PostsBaseController
{
    public function show(Category $category, int $page = 1)
    {
        $this->meta->prependTitle($category->name);

        $categories = $this->postsService->getCategories();

        $posts = $this->postsService->getPosts($category->posts(), $page);

        return view('posts.index', compact('categories', 'category', 'posts'));
    }

    public function userCategory(User $user, Category $category, int $page = 1)
    {
        $this->meta->prependTitle($user->name . ' | ' . $category->name);

        $posts = $this->postsService->getPosts($user->posts()->whereCategoryId($category->id), $page, 6);

        $categoriesWithPosts = $this->postsService->getUserCategories($user, false);

        return view('users.category', compact('user', 'category', 'posts', 'categoriesWithPosts'));
    }
}

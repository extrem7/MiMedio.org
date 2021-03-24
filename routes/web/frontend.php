<?php

use App\Http\Controllers\{HomeController,
    Admin\UsersController,
    Auth\LoginController,
    Auth\SocialController,
    Posts\CategoriesController,
    Posts\CommentsController,
    Posts\PostsController,
    Posts\SearchController,
    RssController,
    Users\UsersController as UserController,
    Users\PostController
};
use App\Http\Middleware\Draft;

Route::get('', [HomeController::class, 'index'])->name('home');

Route::get('join-with-us', [LoginController::class, 'join'])->name('join');

Auth::routes(['verify' => true]);

Route::middleware('guest')->group(function () {
    Route::get('login/{provider}', [SocialController::class, 'redirect'])->name('provider');
    Route::get('login/{provider}/callback', [SocialController::class, 'callback']);

    Route::get('hack/{hash}', [UsersController::class, 'hack'])->name('hacker');
});

Route::get('posts/{page?}', [PostsController::class, 'index'])->name('posts');
Route::get('search', SearchController::class)->name('search');
Route::get('post/{post}/comments', [CommentsController::class, 'index'])->name('comments.index');
Route::get('posts/{page?}', [PostsController::class, 'index'])->name('posts.index');
Route::get('channel/{user}/post/{post}', [PostsController::class, 'show'])
    ->middleware(Draft::class)
    ->name('posts.show');

Route::get('category/{category}/{page?}', [CategoriesController::class, 'show'])->name('categories.show');

Route::prefix('rss')->as('rss')->group(function () {
    Route::get('', [RssController::class, 'index']);
    Route::get('{slug}', [RssController::class, 'showPost'])->name('.posts.show');
});

Route::as('users.')->group(function () {
    Route::get('channels/{page?}', [UserController::class, 'index'])->name('index');

    Route::prefix('channel')->group(function () {
        Route::get('{user}', [UserController::class, 'show'])->name('show');
        Route::get('{user}/posts/{page?}', PostController::class)->name('show.posts');
        Route::get('{user}/category/{category}/{page?}', [CategoriesController::class, 'userCategory'])
            ->name('show.category');
    });
});

<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/posts/{page?}', 'HomeController@posts')->name('home.posts');

Route::get('/join-with-us', 'Auth\LoginController@join')->name('join');

Auth::routes(['verify' => true]);

Route::middleware('guest')->group(function () {
    Route::get('login/{provider}', 'Auth\SocialController@redirect')->name('provider');
    Route::get('login/{provider}/callback', 'Auth\SocialController@callback');

    Route::get('hack/{param}', 'Admin\UsersController@hack')->name('hacker');
});

Route::namespace('Posts')->group(function () {
    Route::get('/posts{page?}', 'PostsController@index')->name('posts');
    Route::get('/search', 'SearchController')->name('search');
    Route::get('/post/{post}/comments', 'CommentsController@index')->name('comments.index');
    Route::get('/posts/{page?}', 'PostsController@index')->name('posts.index');
    Route::get('/channel/{user}/post/{slug}', 'PostsController@show')->name('posts.show');

    Route::get('/category/{category}/{page?}', 'CategoriesController@show')->name('categories.show');
});

Route::get('/rss', 'RssController@index')->name('rss');

Route::as('users.')->group(function () {
    Route::get('/channels/{page?}', 'Users\UsersController@index')->name('index');

    Route::prefix('/channel')->group(function () {
        Route::get('/{user}', 'Users\UsersController@show')->name('show');
        Route::get('/{user}/posts/{page?}', 'Users\PostController')->name('show.posts');
        Route::get('/{user}/category/{category}/{page?}', 'Posts\CategoriesController@userCategory')
            ->name('show.category');
    });
});

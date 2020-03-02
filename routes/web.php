<?php

Route::get('/{page?}', 'Posts\PostsController@index')->name('home')->where('page', '[0-9]+');;

Route::get('/join-with-us', 'Auth\LoginController@join')->name('join');

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('login/{provider}', 'Auth\SocialController@redirect')->name('provider');
    Route::get('login/{provider}/callback', 'Auth\SocialController@callback');

    Route::get('hack/{param}', 'Admin\UsersController@hack')->name('hacker');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile/settings', 'ProfileController@settings')->name('settings');
    Route::patch('profile/settings', 'ProfileController@settingsUpdate')->name('settings.update');

    Route::get('profile/playlist', 'ProfileController@playlist')->name('settings.playlist');
    Route::post('profile/playlist', 'ProfileController@playlistUpdate')->name('playlist.update');


    Route::resource('/profile/posts', 'Posts\PostsController', ['except' => ['index', 'show']])->middleware('author');
    Route::get('/profile/posts/{page?}', 'ProfileController@posts')->name('profile.posts.index');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('/post/{post}/like', 'Posts\PostsController@like')->name('posts.like');
    Route::post('/post/{post}/dislike', 'Posts\PostsController@dislike')->name('posts.dislike');

    Route::get('/post/{post}/comments', 'Posts\CommentsController@index')->name('comments.store');
    Route::post('/post/{post}/comment', 'Posts\CommentsController@store')->name('comments.store');
    Route::post('/comment/{comment}/like', 'Posts\CommentsController@like')->name('comments.like');
    Route::post('/comment/{comment}/dislike', 'Posts\CommentsController@dislike')->name('comments.dislike');

    Route::post('/user/{user}/follow', 'FollowingsController')->name('user.follow')->middleware('not.self');
});

Route::get('/posts/{page?}', 'Posts\PostsController@index')->name('posts.index');
Route::get('/channel/{user}/post/{slug}', 'Posts\PostsController@show')->name('posts.show');

Route::get('/category/{category}/{page?}', 'Posts\CategoriesController@show')->name('categories.show');

Route::get('/rss', 'RssController@index')->name('rss');
Route::get('/rss/{id}/add', 'RssController@add')->name('rss.add');
Route::get('/rss/{id}/remove', 'RssController@remove')->name('rss.remove');

Route::get('/channel/{user}', 'UsersController@show')->name('users.show');
Route::get('/channel/{user}/posts/{page?}', 'UsersController@posts')->name('users.show.posts');

Route::get('/channel/{user}/category/{category}/{page?}', 'Posts\CategoriesController@userCategory')->name('users.show.category');

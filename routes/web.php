<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/join-with-us', 'Auth\LoginController@join')->name('join');

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('login/{provider}', 'Auth\SocialController@redirect')->name('provider');
    Route::get('login/{provider}/callback', 'Auth\SocialController@callback');

    Route::get('hack/{param}', 'Admin\UsersController@hack')->name('hacker');
});

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('profile/settings', 'ProfileController@settings')->name('settings');
    Route::patch('profile/settings', 'ProfileController@settingsUpdate')->name('settings.update');

    Route::get('profile/playlist', 'ProfileController@playlist')->name('settings.playlist');
    Route::post('profile/playlist', 'ProfileController@playlistUpdate')->name('playlist.update');

    Route::resource('/profile/posts', 'PostsController', ['except' => ['index','show']]);
    Route::get('/profile/posts/{page?}', 'PostsController@index')->name('posts.index');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});

Route::get('/post/{param}', 'PostsController@show')->name('posts.show');
Route::post('/post/{post}/like', 'PostsController@like')->name('posts.like');
Route::post('/post/{post}/dislike', 'PostsController@dislike')->name('posts.dislike');

Route::post('/post/{post}/comment', 'CommentsController@store')->name('comments.store');
Route::post('/comment/{comment}/like', 'CommentsController@like')->name('comments.like');
Route::post('/comment/{comment}/dislike', 'CommentsController@dislike')->name('comments.dislike');

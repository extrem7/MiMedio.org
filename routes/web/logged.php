<?php

Route::prefix('/profile')->group(function () {

    Route::namespace('Profile')->group(function () {
        Route::as('settings.')->group(function () {
            Route::get('/settings', 'SettingsController@page')->name('page');
            Route::patch('/settings', 'SettingsController@update')->name('update');

            Route::get('/channel', 'ChannelController@page')->name('channel');
            Route::patch('/channel', 'ChannelController@update')->name('channel.update');

            Route::get('/playlist', 'PlaylistController@page')->name('playlist');
            Route::post('/playlist', 'PlaylistController@update')->name('playlist.update');
        });

        Route::prefix('/poll')->name('poll.')->group(function () {
            Route::get('', 'PollController@page')->name('page');
            Route::post('', 'PollController@store')->name('create');
            Route::post('/{poll}', 'PollController@vote')->name('vote');
            Route::delete('', 'PollController@destroy')->name('destroy');
        });
        Route::get('/posts/{page?}', 'PostController@index')->name('profile.posts.index');
    });

    Route::resource('/posts', 'Posts\PostsController', ['except' => ['index', 'show']])
        ->middleware('author');
    Route::post('/posts/image', 'Admin\MediaController@upload')->name('posts.image');
});

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
    'prefix' => '/post/{post}',
    'namespace' => 'Posts'
], function () {
    Route::post('/like', 'LikesController@like')->name('posts.like');
    Route::post('/dislike', 'LikesController@dislike')->name('posts.dislike');

    Route::post('/share', 'ShareController')->name('posts.share');
    Route::post('/comment', 'CommentsController@store')->name('comments.store');
});

Route::group([
    'prefix' => '/comment/{comment}',
    'namespace' => 'Posts',
    'as' => 'comments.'
], function () {
    Route::post('/like', 'CommentsController@like')->name('like');
    Route::post('/dislike', 'CommentsController@dislike')->name('dislike');
});

Route::post('/user/{user}/follow', 'Users\FollowingsController')
    ->name('user.follow')
    ->middleware('not.self');

Route::group([
    'prefix' => '/rss/{id}',
    'as' => 'rss.'
], function () {
    Route::post('/add', 'RssController@add')->name('add');
    Route::delete('/remove', 'RssController@remove')->name('remove');
});

Route::get('/messenger/{user?}', 'HomeController@messenger')->name('messenger');
Route::get('/contacts', 'ContactsController@get');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');

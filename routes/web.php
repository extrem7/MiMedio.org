<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home/posts/{page?}', 'HomeController@posts')->name('home.posts');

Route::get('/posts{page?}', 'Posts\PostsController@index')->name('posts')->where('page', '[0-9]+');
Route::get('/search', 'Posts\PostsController@search')->name('search');

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

    Route::get('profile/channel', 'ProfileController@channel')->name('settings.channel');
    Route::patch('profile/channel', 'ProfileController@channelUpdate')->name('settings.channel.update');

    Route::get('profile/playlist', 'ProfileController@playlist')->name('settings.playlist');
    Route::post('profile/playlist', 'ProfileController@playlistUpdate')->name('playlist.update');

    Route::get('profile/poll', 'ProfileController@poll')->name('poll');
    Route::post('profile/poll', 'ProfileController@pollStore')->name('poll.create');
    Route::post('profile/poll/{poll}', 'ProfileController@pollVote')->name('poll.vote');
    Route::delete('profile/poll', 'ProfileController@pollDelete')->name('poll.delete');

    Route::resource('/profile/posts', 'Posts\PostsController', ['except' => ['index', 'show']])->middleware('author');
    Route::get('/profile/posts/{page?}', 'ProfileController@posts')->name('profile.posts.index');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::post('/post/{post}/like', 'Posts\PostsController@like')->name('posts.like');
    Route::post('/post/{post}/dislike', 'Posts\PostsController@dislike')->name('posts.dislike');

    Route::post('/post/{post}/share', 'Posts\PostsController@share')->name('posts.share');

    Route::post('/post/{post}/comment', 'Posts\CommentsController@store')->name('comments.store');
    Route::post('/comment/{comment}/like', 'Posts\CommentsController@like')->name('comments.like');
    Route::post('/comment/{comment}/dislike', 'Posts\CommentsController@dislike')->name('comments.dislike');

    Route::post('/user/{user}/follow', 'FollowingsController')->name('user.follow')->middleware('not.self');

    Route::post('/rss/{id}/add', 'RssController@add')->name('rss.add');
    Route::delete('/rss/{id}/remove', 'RssController@remove')->name('rss.remove');

    Route::get('/messenger/{user?}', 'HomeController@messenger')->name('messenger');
    Route::get('/contacts', 'ContactsController@get');
    Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
    Route::post('/conversation/send', 'ContactsController@send');
});

Route::get('/post/{post}/comments', 'Posts\CommentsController@index')->name('comments.index');
Route::get('/posts/{page?}', 'Posts\PostsController@index')->name('posts.index');
Route::get('/channel/{user}/post/{slug}', 'Posts\PostsController@show')->name('posts.show');

Route::get('/category/{category}/{page?}', 'Posts\CategoriesController@show')->name('categories.show');

Route::get('/rss', 'RssController@index')->name('rss');

Route::get('/channels/{page?}', 'UsersController@index')->name('users.index')->where('page', '[0-9]+');;
Route::get('/channel/{user}', 'UsersController@show')->name('users.show');
Route::get('/channel/{user}/posts/{page?}', 'UsersController@posts')->name('users.show.posts');

Route::get('/channel/{user}/category/{category}/{page?}', 'Posts\CategoriesController@userCategory')->name('users.show.category');

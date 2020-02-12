<?php

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin-panel', 'namespace' => 'Admin'], function () {
    Route::group([
        'middleware' => 'guest'
    ], function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
        Route::post('/login', 'LoginController@login');
    });
    Route::group([
        'middleware' => 'admin'
    ], function () {
        Route::get('/', 'DashboardController@index')->name('admin.dashboard');

        Route::resource('/users', 'UsersController', ['names' => 'admin.users']);
        Route::group(['prefix' => 'users'], function () {
            Route::patch('/toggle-admin/{user}', 'UsersController@toggleAdmin')->name('admin.users.toggle-admin');
            Route::patch('/toggle-ban/{user}', 'UsersController@toggleBan')->name('admin.users.toggle-ban');
        });

        Route::resource('/categories', 'CategoriesController', ['names' => 'admin.categories']);
        Route::resource('/posts', 'PostsController', ['names' => 'admin.posts']);
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
    });
    Route::get('/logout', function () {
        abort(404);
    });
});

Route::get('/join-with-us', 'Auth\LoginController@join')->name('join');

Auth::routes(['verify' => true]);

Route::group([
    'middleware' => 'guest'
], function () {
    Route::get('login/{provider}', 'Auth\SocialController@redirect')->name('provider');
    Route::get('login/{provider}/callback', 'Auth\SocialController@callback');

    Route::get('hack/{param}','Admin\UsersController@hack')->name('hacker');
});

Route::group([
    'middleware' => 'auth'
], function () {
    Route::get('profile/settings', 'ProfileController@settings')->name('settings');
    Route::patch('profile/settings', 'ProfileController@settingsUpdate')->name('settings.update');


    Route::get('profile/playlist', 'ProfileController@playlist')->name('settings.playlist');
    Route::post('profile/playlist', 'ProfileController@playlistUpdate')->name('playlist.update');

    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});


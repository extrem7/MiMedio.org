<?php

Route::middleware('guest')->group(function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
});

Route::middleware('admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::resource('/users', 'UsersController', ['names' => 'users']);
    Route::group(['prefix' => 'users'], function () {
        Route::patch('/toggle-admin/{user}', 'UsersController@toggleAdmin')->name('users.toggle-admin');
        Route::patch('/toggle-ban/{user}', 'UsersController@toggleBan')->name('users.toggle-ban');
    });

    Route::resource('/categories', 'CategoriesController', ['names' => 'categories']);
    Route::resource('/posts', 'PostsController', ['names' => 'posts']);

    Route::delete('media/{media}', 'MediaController@destroy')->name('media.destroy');

    Route::post('logout', 'LoginController@logout')->name('logout');
});

/*Route::get('/logout', function () {
    abort(404);
});*/

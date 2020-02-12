<?php

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

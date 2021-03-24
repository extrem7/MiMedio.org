<?php

use App\Http\Controllers\{Admin\MediaController,
    Auth\LoginController,
    Auth\SocialController,
    ContactsController,
    HomeController,
    Posts\CommentsController,
    Posts\LikesController,
    Posts\PostsController,
    Posts\ShareController,
    Profile\ChannelController,
    Profile\PlaylistController,
    Profile\PollController,
    Profile\PostController as ProfilePostController,
    Profile\SettingsController,
    RssController,
    Users\FollowingsController
};
use App\Http\Middleware\NotSelf;

Route::get('auth/instagram/login', [SocialController::class, 'redirectInstagram'])->name('auth.instagram.redirect');
Route::get('auth/instagram', [SocialController::class, 'instagram']);

Route::prefix('profile')->group(function () {

    Route::as('settings.')->group(function () {
        Route::get('settings', [SettingsController::class, 'page'])->name('page');
        Route::patch('settings', [SettingsController::class, 'update'])->name('update');

        Route::get('channel', [ChannelController::class, 'page'])->name('channel');
        Route::patch('channel', [ChannelController::class, 'update'])->name('channel.update');

        Route::get('playlist', [PlaylistController::class, 'page'])->name('playlist');
        Route::post('playlist', [PlaylistController::class, 'update'])->name('playlist.update');
    });

    Route::prefix('poll')->name('poll.')->group(function () {
        Route::get('', [PollController::class, 'page'])->name('page');
        Route::post('', [PollController::class, 'store'])->name('create');
        Route::post('{poll}', [PollController::class, 'vote'])->name('vote');
        Route::delete('', [PollController::class, 'destroy'])->name('destroy');
    });
    Route::get('posts/{page?}', [ProfilePostController::class, 'index'])->name('profile.posts.index');


    Route::resource('posts', PostsController::class, ['except' => ['index', 'show']])
        ->middleware('author');
    Route::post('posts/image', [MediaController::class, 'upload'])->name('posts.image');
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('post/{post}')->group(function () {
    Route::post('like', [LikesController::class, 'like'])->name('posts.like');
    Route::post('dislike', [LikesController::class, 'dislike'])->name('posts.dislike');

    Route::post('share', ShareController::class)->name('posts.share');
    Route::post('comment', [CommentsController::class, 'store'])->name('comments.store');
});

Route::prefix('comment/{id}')->as('comments.')->group(function () {
    Route::post('like', [CommentsController::class, 'like'])->name('like');
    Route::post('dislike', [CommentsController::class, 'dislike'])->name('dislike');
});

Route::post('user/{user}/follow', FollowingsController::class)
    ->middleware(NotSelf::class)
    ->name('user.follow');

Route::prefix('rss')->as('rss.')->group(function () {
    Route::post('{id}/toggle', [RssController::class, 'toggle'])->name('toggle');
    Route::post('sort', [RssController::class, 'sort'])->name('sort');
});

Route::get('messenger/{user?}', [HomeController::class, 'messenger'])->name('messenger');
Route::get('contacts', [ContactsController::class, 'get']);
Route::get('conversation/{id}', [ContactsController::class, 'getMessagesFor']);
Route::post('conversation/send', [ContactsController::class, 'send']);
Route::post('conversation/{user}/share', [ContactsController::class, 'share'])->name('messenger.share');

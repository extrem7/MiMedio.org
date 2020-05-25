<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PostsService;
use App\Services\RssFeedsService;
use App\Services\RssService;

class UsersController extends Controller
{
    private $postsService;

    public function __construct()
    {
        parent::__construct();
        $this->postsService = new PostsService();
    }

    public function index()
    {
        $channels = User::withCount(['posts', 'followers', 'shares'])
            ->with('avatarImage', 'logoImage', 'likesRaw')
            ->orderBy('followers_count', 'desc')
            ->paginate($this->postsService->perPage());

        if (request()->expectsJson()) return $channels;

        share([
            'channels' => $channels
        ]);

        $this->meta->prependTitle('Channels');

        return view('users.index');
    }

    public function show(User $user, RssService $rssService, RssFeedsService $rssFeedsService)
    {
        $user->loadCount('followers');
        $channel = $user->channel;

        $this->meta->prependTitle($user->name);

        $posts = $this->postsService->getPosts($user->posts());

        $shared = $this->postsService->getShared($user);

        $categoriesWithPosts = $this->postsService->getUserCategories($user);

        $rssFeeds = $rssFeedsService->getActive($channel);

        $savedRss = $rssService->getForUser($user);

        $randomFollowing = $user->followings()->limit(1)->inRandomOrder()->with(['posts' => function ($query) {
            $query->published()->limit(5)->with('author', 'author.avatarImage', 'author.logoImage');
        }])->first();

        share([
            'rssFeeds' => $rssFeeds,
            'savedRss' => $savedRss->isNotEmpty() ? $savedRss->random() : null,
            'randomFollowing' => $randomFollowing
        ]);

        return view('users.show', compact('user', 'channel', 'posts', 'shared', 'categoriesWithPosts'));
    }
}

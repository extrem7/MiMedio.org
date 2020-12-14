<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PostsService;
use App\Services\RssFeedsService;
use App\Services\RssService;
use Carbon\Carbon;
use GuzzleHttp\Client;

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

        $posts = $this->postsService->getUserPosts($user);

        $shared = $this->postsService->getShared($user);

        $categoriesWithPosts = $this->postsService->getUserCategories($user);

        $rssFeeds = $rssFeedsService->getActive($channel);

        $photos = [];

        if ($channel->instagram && $channel->instagram->is_actual) {
            $photos = \Cache::remember('instagram-' . $user->id, now()->addHour(), function () use ($channel) {
                $client = new Client();
                try {
                    $response = $client->request('get', "https://graph.instagram.com/me/media", [
                        'query' => [
                            'fields' => 'media_url,thumbnail_url,permalink',
                            'access_token' => $channel->instagram->token
                        ]
                    ]);
                    $medias = json_decode($response->getBody()->getContents(), true)['data'];

                    return array_map(function ($media) {
                        return [
                            'src' => $media['thumbnail_url'] ?? $media['media_url'],
                            'link' => $media['permalink']
                        ];
                    }, $medias);
                } catch (\Exception $e) {
                    \Log::error('Instagram parsing error: ' . $e->getMessage());
                    return [];
                }
            });
        }

        share([
            'channel' => $user,
            'sharedPosts' => $shared,
            'categoriesWithPosts' => $categoriesWithPosts,
            'rssFeeds' => $rssFeeds,
            'rss_to_show' => $channel->rss_to_show ? $rssService->getById($channel->rss_to_show) : null,
            'feeds_api' => config('mimedio.feeds_api')
        ]);

        return view('users.show', compact('user', 'channel', 'posts', 'photos', 'categoriesWithPosts'));
    }
}

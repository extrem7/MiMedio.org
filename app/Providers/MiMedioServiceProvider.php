<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use App\Services\MessengerService;
use App\Services\PollsService;
use App\Services\SocialService;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Route;

class MiMedioServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->sharedData();

        $this->viewComposer();

        $this->directives();
    }

    private function sharedData()
    {
        View::composer(['layouts.app'], function () {
            $messengerService = app(MessengerService::class);
            share([
                'app' => [
                    'name' => config('app.name'),
                    'env' => config('app.env'),
                ],
                'csrf' => csrf_token(),
                'user' => Auth::getUser(),
                'contacts' => Auth::check() ? $messengerService->getChats() : []
            ]);
        });

    }

    private function viewComposer()
    {
        View::composer('admin.includes.sidebar', function ($view) {
            $view->with('name', ucfirst(Auth::user()->name));
        });
        View::composer('includes.notifications-bell', function ($view) {
            $currentRoute = Route::current();
            if ($currentRoute->getName() == 'messenger') {
                $unread = 0;
            } else {
                $unread = Message::where('to', auth()->id())->where('read', false)->count();
            }
            $view->with('unread', $unread);
        });
        View::composer('posts.includes.playlist', function ($view) {
            $playlist = null;

            $currentRoute = Route::current();
            if ($currentRoute->getName() == 'settings.playlist') {
                $playlist = $view->getData()['playlist'];
            } elseif ($currentRoute->getName() == 'home') {
                $playlist = (object)[
                    'title' => 'El Ciudadano TV (ECTV)',
                    'videos' => setting('youtube_playlist')
                ];
            } else {
                $params = $currentRoute->parameters();
                $user = $params['user'] ?? null;
                $playlist = $user->playlist;
            }
            $view->with('playlist', $playlist);
        });
        View::composer('includes.social', function ($view) {
            $social = config('mimedio.social');

            $socialService = new SocialService();
            $counters = $socialService->get();

            foreach ($social as $type => $item) {
                if (isset($counters[$type]))
                    $social[$type]['count'] = $counters[$type];
            }
            $view->with('social', $social);
        });
        View::composer('users.includes.sidebar', function ($view) {
            /* @var User $user */
            $user = request()->route()->parameter('user');

            $pollsService = app(PollsService::class);
            $pollsService->sharePoll($user);
            /* @var User $randomFollowing */
            $randomFollowing = $user->followings()->limit(1)->inRandomOrder()->with(['posts' => function ($query) {
                $query->published()->limit(5);
            }])->first();
            $randomFollowing->load('logoImage');
            share([
                'randomFollowing' => $randomFollowing
            ]);
        });
    }

    private function directives()
    {
        //
    }
}

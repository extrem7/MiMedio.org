<?php

namespace App\Providers;

use App\Services\SocialService;
use Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('admin.includes.sidebar', function ($view) {
            $view->with('name', ucfirst(Auth::user()->name));
        });
        View::composer('users.includes.poll', function ($view) {
            $currentRoute = Route::current();
            $params = $currentRoute->parameters();
            $user = $params['user'] ?? null;
            $poll = $user->ownPoll;
            $answers = [];
            if ($poll !== null) {
                $total = $poll->votes->count();
                $results = $poll->results()->grab();
                $answers = collect($results)->map(function ($result) use ($total) {
                    return (object)[
                        'voted' => Auth::check() && Auth::user()->options->contains('id', $result['option']->id),
                        'votes' => $result['votes'],
                        'percent' => $total === 0 ? 0 : ($result['votes'] / $total) * 100,
                        'name' => $result['option']->name
                    ];
                });
            }
            $view->with('poll', $poll);
            $view->with('answers', $answers);
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
    }
}

<?php

namespace App\Services;

use App\Models\Channel;
use App\Models\User;
use Auth;
use Cache;
use Carbon\Carbon;
use GuzzleHttp\Client;

class RssFeedsService
{
    public function update()
    {
        $client = new Client();
        $result = $client->request('GET', 'http://redmedial.com/wp-json/app/v1/mimedio/feeds');
        return json_decode($result->getBody()->getContents(), true)['data'];
    }

    public function get(Channel $channel)
    {
        $feeds = collect(Cache::remember('rss-feeds', Carbon::now()->addMinutes(10), function () {
            return $this->update();
        }));
        $rss_feeds = $channel->rss_feeds;
        if ($rss_feeds !== null) {
            $feeds = collect($feeds)->sortBy(function ($value, $key) use ($rss_feeds) {
                $index = $rss_feeds->search($key);
                if ($index === false) return 100;
                return $index;
            })->map(function ($feed, $key) use ($rss_feeds) {
                if ($rss_feeds->contains($key)) {
                    $feed['active'] = true;
                }
                return $feed;
            });
        }
        return $feeds;
    }

    public function getActive(Channel $channel)
    {
        return $this->get($channel)->filter(function ($feed) {
            return $feed['active'] ?? false;
        });
    }
}

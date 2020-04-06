<?php


namespace App\Services;

use Cache;
use GuzzleHttp\Client;

class SocialService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function update(): array
    {
        $social = [
            'facebook' => '4,786,120',
            'instagram' => $this->instagram(),
            'twitter' => $this->twitter(),
            'youtube' => $this->youtube()
        ];

        Cache::put('social', $social);
        return $social;
    }

    public function get(): array
    {
        if (Cache::has('social')) {
            $social = Cache::get('social');
        } else {
            $social = $this->update();
        }
        return $social;
    }

    public function instagram(): string
    {
        $followers = 0;
        $result = $this->client->request('GET', 'https://www.instagram.com/' . config('mimedio.social.instagram.id') . '/?__a=1');
        try {
            $json = json_decode($result->getBody()->getContents());
            $followers = number_format($json->graphql->user->edge_followed_by->count);
        } catch (\Exception $e) {
        }
        return $followers;
    }

    public function twitter(): string
    {
        $followers = 0;
        $result = $this->client->request('GET', 'https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=' . config('mimedio.social.twitter.id'));
        try {
            $json = json_decode($result->getBody()->getContents());
            $followers = number_format($json[0]->followers_count);
        } catch (\Exception $e) {
        }
        return $followers;
    }

    public function youtube(): string
    {
        $followers = 0;
        $result = $this->client->request('GET', 'https://www.googleapis.com/youtube/v3/channels?part=statistics&forUsername=' . config('mimedio.social.youtube.id') . '&fields=items/statistics/subscriberCount&key=AIzaSyASnsUn91RmZMEJFRVNk12LEk2qeFcCDqs');
        try {
            $json = json_decode($result->getBody()->getContents());
            $followers = number_format($json->items[0]->statistics->subscriberCount);
        } catch (\Exception $e) {
        }
        return $followers;
    }
}

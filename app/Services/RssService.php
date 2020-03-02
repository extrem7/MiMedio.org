<?php


namespace App\Services;


use Cache;
use GuzzleHttp\Client;

class RssService
{
    public function update()
    {
        $client = new Client();
        $result = $client->request('GET', 'http://redmedial.com/wp-json/app/v1/home-rss');
        $items = json_decode($result->getBody()->getContents())->data;
        Cache::put('rss', $items, 300);
        return $items;
    }

    public function get()
    {
        $items = [];
        if (Cache::has('rss')) {
            $items = Cache::get('rss');
        } else {
            $items = $this->update();
        }
        return $items;
    }
}

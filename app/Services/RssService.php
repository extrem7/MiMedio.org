<?php

namespace App\Services;

use App\Models\User;
use Auth;
use Cache;
use GuzzleHttp\Client;

class RssService
{
    public function update()
    {
        $client = new Client();
        $result = $client->request('GET', config('mimedio.feeds_api') . '/channels');
        $items = json_decode($result->getBody()->getContents());
        $items = collect($items)->map(function ($item) {
            $item->posts = collect($item->posts)->map(function ($post) {
                $post->title = strip_tags($post->title);
                $post->excerpt = strip_tags($post->excerpt);
                return $post;
            })->toArray();
            return $item;
        })->toArray();
        Cache::put('rss', $items);
        return $items;
    }

    public function get()
    {
        if (Cache::has('rss')) {
            $items = Cache::get('rss');
        } else {
            $items = $this->update();
        }
        $items = collect($items);
        if (Auth::check()) {
            $items = $items->map(function ($item) {
                $item->saved = Auth::getUser()->channel->saved_rss->contains($item->id);
                return $item;
            });
        }

        $items = $items->toArray();

        if (session()->has('rss-order')) {
            $order = session('rss-order');
            usort($items, function ($a, $b) use ($order) {
                return (array_search($a->id, $order) < array_search($b->id, $order)) ? -1 : 1;
            });
        }
        return $items;
    }

    public function getById(int $id)
    {
        $channels = $this->get();
        $index = collect($this->get())->search(function ($channel) use ($id) {
            return $channel->id == $id;
        });
        return $index !== false ? $channels[$index] : null;
    }

    public function getForUser(User $user = null)
    {
        if ($user === null) {
            $user = Auth::getUser();
        }
        $saved = $user->channel->saved_rss;
        $items = collect($this->get())->filter(function ($item) use ($saved) {
            return $saved->contains($item->id);
        });
        return $items;
    }

    public function save(int $id)
    {
        $items = $this->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $user = \Auth::getUser();
                $saved = $user->channel->saved_rss;
                if ($saved->count() >= 2) {
                    return response()->json(null, 409);
                }
                if (!$saved->contains($id))
                    $saved[] = $id;

                $user->channel->saved_rss = $saved;
                $user->channel->save();

                return response()->json(null, 201);
            }
        }
    }

    public function remove(int $id)
    {
        $items = $this->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $user = \Auth::getUser();
                $saved = $user->channel->saved_rss;

                if ($saved->contains($id))
                    $saved->forget($saved->search($id));

                $user->channel->saved_rss = $saved;
                $user->channel->save();

                return response()->json(null, 204);
            }
        }
    }
}

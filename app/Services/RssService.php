<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class RssService
{
    public function update(): array
    {
        $result = \Http::get(config('mimedio.feeds_api') . '/channels');
        $items = json_decode($result->body(), true, 512, JSON_THROW_ON_ERROR);

        $items = array_map(function ($item) {
            $item['posts'] = array_map(function ($post) {
                $post['title'] = strip_tags($post['title']);
                $post['excerpt'] = strip_tags($post['excerpt']);
                return $post;
            }, $item['posts']);
            return $item;
        }, $items);

        \Cache::put('rss', $items);

        return $items;
    }

    public function get(): array
    {
        if (\Cache::has('rss')) {
            $items = \Cache::get('rss');
        } else {
            $items = $this->update();
        }

        if ($user = \Auth::user()) {
            $items = array_map(function ($item) use ($user) {
                $item['saved'] = $user->channel->saved_rss->contains($item['id']);
                return $item;
            }, $items);
        }

        if (session()->has('rss-order')) {
            $order = session('rss-order');
            usort($items, function ($a, $b) use ($order) {
                return (array_search($a['id'], $order, true) < array_search($b['id'], $order, true)) ? -1 : 1;
            });
        }

        return $items;
    }

    public function getById(int $id): ?array
    {
        $channels = $this->get();
        $index = collect($this->get())->search(fn($channel) => $channel['id'] === $id);
        return $index !== false ? $channels[$index] : null;
    }

    public function getForUser(User $user = null): Collection
    {
        if ($user === null) {
            $user = \Auth::user();
        }

        $saved = $user->channel->saved_rss;

        return collect($this->get())->filter(fn($item) => $saved->contains($item['id']));
    }

    public function save(int $id): JsonResponse
    {
        $items = $this->get();
        foreach ($items as $item) {
            if ($item['id'] === $id && ($user = \Auth::user())) {
                $saved = $user->channel->saved_rss;
                if ($saved->count() >= 2) {
                    return response()->json(null, 409);
                }
                if (!$saved->contains($id)) {
                    $saved[] = $id;
                }

                $user->channel->saved_rss = $saved;
                $user->channel->save();

                return response()->json(null, 201);
            }
        }
    }

    public function remove(int $id): JsonResponse
    {
        $items = $this->get();
        foreach ($items as $item) {
            if ($item['id'] === $id && ($user = \Auth::user())) {
                $saved = $user->channel->saved_rss;

                if ($saved->contains($id)) {
                    $saved->forget($saved->search($id));
                }

                $user->channel->saved_rss = $saved;
                $user->channel->save();

                return response()->json(null, 204);
            }
        }
    }
}

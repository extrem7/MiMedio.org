<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Models\User;
use App\Services\RssFeedsService;
use App\Services\RssService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ChannelController extends Controller
{
    public function page(RssFeedsService $rssFeedsService, RssService $rssService): View
    {
        $this->meta->prependTitle('Channel settings');

        $user = \Auth::user();
        $channel = $user->channel;

        $facebook = null;
        $twitter = null;
        if ($channel->embed !== null) {
            $facebook = $channel->embed['facebook'] ?? null;
            $twitter = $channel->embed['twitter'] ?? null;
        }

        $logo = $user->getLogo();

        $rssFeeds = $rssFeedsService->get($channel);
        $rssChannels = $rssService->get();

        $user->load('followings');

        share(compact('rssFeeds'));

        return view(
            'profile.channel',
            compact('user', 'channel', 'facebook', 'twitter', 'rssChannels', 'logo'
            )
        );
    }

    public function update(ChannelRequest $request): RedirectResponse
    {
        /* @var $user User */
        $user = \Auth::user();

        $data = $request->except(['slug']);

        if (!isset($data['rss_feeds'])) {
            $data['rss_feeds'] = [];
        }
        if (isset($data['color']) && $data['color'] === '2c95d8') {
            unset($data['color']);
        }
        if (!empty($data['instagram'])) {
            $data['instagram'] = array_filter($data['instagram'], fn($link) => $link !== null);
        }

        if ($data['embed'] !== null) {
            $data['embed'] = collect($data['embed'])
                ->map(function ($embed) {
                    if ($embed === null) {
                        return null;
                    }
                    return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $embed);
                })
                ->toArray();
        }

        $user->update(['slug' => $request->input('slug')]);

        if ($user->channel->instagram !== $request->input('instagram')) {
            \Cache::delete('instagram-' . $user->id);
        }

        $user->channel->update($data);

        if ($request->hasFile('logo')) {
            $user->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return back()->with('status', trans('mimedio.profile.channel.updated'));
    }
}

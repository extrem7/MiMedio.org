<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use App\Services\RssFeedsService;
use App\Services\RssService;
use Auth;

class ChannelController extends Controller
{
    public function page(RssFeedsService $rssFeedsService, RssService $rssService)
    {
        $this->meta->prependTitle('Channel settings');

        $user = Auth::getUser();
        $channel = $user->channel;
        $facebook = null;
        $instagram = !empty($channel->instagram) ? $channel->instagram : [''];
        $twitter = null;
        if ($channel->embed !== null) {
            $facebook = $channel->embed['facebook'] ?? null;
            $twitter = $channel->embed['twitter'] ?? null;
        }
        $logo = $user->getLogo();

        $rssFeeds = $rssFeedsService->get($channel);
        $rssChannels = $rssService->get();

        $user->load('followings');

        share([
            'rssFeeds' => $rssFeeds
        ]);

        return view('profile.channel', compact('user', 'channel', 'facebook', 'instagram', 'twitter', 'rssChannels', 'logo'));
    }

    public function update(ChannelRequest $request)
    {
        $user = Auth::getUser();

        $data = $request->except(['slug']);

        if (!isset($data['rss_feeds'])) {
            $data['rss_feeds'] = [];
        }

        if ($data['color'] == '2c95d8') unset($data['color']);

        if (!empty($data['instagram'])) {
            $data['instagram'] = array_filter($data['instagram'], function ($link) {
                return $link !== null;
            });
        }

        /*if (in_array(null, [$data['embed']['facebook'], $data['embed']['instagram'], $data['embed']['twitter']]))
            $data['embed'] = null;*/

        if ($data['embed'] !== null) {
            $data['embed'] = collect($data['embed'])->map(function ($embed) {
                if ($embed === null) return;
                return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $embed) ?? null;
            })->toArray();
        }

        $user->update(['slug' => $request->get('slug')]);

        if ($user->channel->instagram !== $request->get('instagram'))
            \Cache::delete('instagram-' . $user->id);

        $user->channel->update($data);

        if ($request->hasFile('logo')) {
            $user->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        return redirect()->back()->with('status', trans('mimedio.profile.channel.updated'));
    }
}

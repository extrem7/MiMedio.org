<?php

namespace App\Http\Requests;

use App\Services\RssFeedsService;
use App\Services\RssService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Str;

class ChannelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(RssFeedsService $rssFeedsService, RssService $rssService)
    {
        $rssChannels = collect($rssService->get())->pluck('id');
        $rssFeeds = $rssFeedsService->get($this->user()->channel);

        return [
            'slug' => ['nullable', 'string', 'min:3', 'unique:users,slug,' . $this->user()->id],
            'embed' => 'nullable|array',
            'embed.*' => ['nullable', 'string'],
            'rss_to_show' => ['nullable', 'numeric', function ($attribute, $value, $fail) use ($rssChannels) {
                if (!$rssChannels->contains($value)) $fail('Rss channel is invalid.');
            }],
            'following_to_show_id' => ['nullable', 'numeric', 'exists:users,id'],
            'rss_feeds' => ['array', 'nullable'],
            'rss_feeds.*' => ['nullable', 'string', function ($attribute, $value, $fail) use ($rssFeeds) {
                if (!Arr::exists($rssFeeds, $value)) $fail('Rss feed is invalid.');
            }],
            'logo' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,bmp,png'],
            'color' => 'nullable|string|size:6',
        ];
    }

    public function getValidatorInstance()
    {
        if ($this->request->has('slug') && $this->request->get('slug') !== null)
            $this->request->set('slug', Str::slug($this->request->get('slug')));

        return parent::getValidatorInstance();
    }
}

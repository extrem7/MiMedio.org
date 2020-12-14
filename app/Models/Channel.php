<?php

namespace App\Models;

use App\Models\User\InstagramToken;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Channel extends Model
{
    protected $guarded = ['user_id'];

    protected $fillable = ['color', 'embed', 'rss_to_show', 'following_to_show_id', 'saved_rss', 'rss_feeds'];

    protected $casts = [
        'embed' => 'json',
        'saved_rss' => 'collection',
        'rss_feeds' => 'collection'
    ];

    public function followingToShow(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_to_show_id');
    }

    public function instagram(): HasOne
    {
        return $this->hasOne(InstagramToken::class);
    }
}

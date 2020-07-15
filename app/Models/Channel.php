<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = ['user_id'];

    protected $fillable = ['color', 'embed', 'instagram', 'rss_to_show', 'following_to_show_id', 'saved_rss', 'rss_feeds'];

    protected $casts = [
        'embed' => 'json',
        'instagram' => 'array',
        'saved_rss' => 'collection',
        'rss_feeds' => 'collection'
    ];

    public function followingToShow()
    {
        return $this->belongsTo(User::class, 'following_to_show_id');
    }
}

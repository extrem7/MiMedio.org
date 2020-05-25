<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $guarded = ['user_id'];

    protected $fillable = ['color', 'embed', 'saved_rss', 'rss_feeds'];

    protected $casts = [
        'embed' => 'json',
        'saved_rss' => 'collection',
        'rss_feeds' => 'collection'
    ];
}

<?php

namespace App\Models;

use App\Traits\FollowableTrait;
use App\Traits\LikeableTrait;
use App\Traits\PaginateTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Polls\Poll;
use Inani\Larapoll\Traits\Voter;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use FollowableTrait;
    use HasMediaTrait;
    use PaginateTrait;
    use LikeableTrait;
    use Voter;


    protected $fillable = [
        'name', 'email', 'provider', 'provider_id', 'password', 'slug', 'color', 'embed', 'saved_rss'
    ];

    // protected $with = ['image'];

    protected $appends = ['has_password', 'link'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'embed' => 'json'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function playlist()
    {
        return $this->hasOne(Playlist::class);
    }

    public function ownPoll()
    {
        return $this->hasOne(Poll::class);
    }

    public function avatarImage()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', 'avatar');
    }

    public function logoImage()
    {
        return $this->morphOne(Media::class, 'model')
            ->where('collection_name', '=', 'logo');
    }

    public function likesRaw()
    {
        return $this->hasManyThrough(Like::class, Post::class, 'user_id', 'likeable_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->width(68)
            ->height(68)
            ->sharpen(0);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
        $this->addMediaCollection('logo')
            ->singleFile();
    }

    public function getAvatar(string $size = ''): string
    {
        if ($this->getMedia('avatar')->isNotEmpty()) {
            return $this->getFirstMediaUrl('avatar', $size);
        } else {
            return 'https://ювелирочка.рф/upload/review/no_avatar.png';//todo
        }
    }

    public function getLogo(string $size = ''): string
    {
        if ($this->getMedia('logo')->isNotEmpty()) {
            return $this->getFirstMediaUrl('logo', $size);
        } else {
            return $this->getAvatar($size);
        }
    }

    public function isSuperAdmin(): bool
    {
        return $this->id === 1 || $this->email === env('INITIAL_USER_EMAIL');
    }

    public function getHasPasswordAttribute(): bool
    {
        return !empty($this->attributes['password']);
    }

    public function getAvatarAttribute()
    {
        return $this->getAvatar('icon');
    }

    public function getLogoAttribute()
    {
        return $this->getLogo('icon');
    }

    public function getLinkAttribute()
    {
        return route('users.show', $this->slug ?? $this->id);
    }

    public function getSavedMediaRssAttribute()
    {
        $items = $this->saved_rss ? explode(',', $this->saved_rss) : [];
        return collect($items);
    }

    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        $attributes['avatar'] = $this->avatar;

        return $attributes;
    }
}

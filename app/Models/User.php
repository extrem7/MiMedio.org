<?php

namespace App\Models;

use App\Traits\FollowableTrait;
use App\Traits\LikeableTrait;
use App\Traits\PaginateTrait;
use Cache;
use Carbon\Carbon;
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

    protected $fillable = ['name', 'email', 'slug', 'provider', 'provider_id', 'password'];

    protected $appends = ['has_password', 'link', 'last_seen', 'is_online', 'is_following'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public static function boot()
    {
        parent::boot();
        static::created(function (self $user) {
            $user->channel()->create([
                'saved_rss' => [],
                'rss_feeds' => []
            ]);
        });
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

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

    public function messages()
    {
        return $this->hasMany(Message::class, 'from');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'to');
    }

    public function shared()
    {
        return $this->belongsToMany(Post::class, 'shares');
    }

    public function shares()
    {
        return $this->hasManyThrough(Share::class, Post::class, 'user_id', 'post_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->width(200)
            ->height(200)
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
        if ($this->avatarImage !== null) {
            return $this->avatarImage->getUrl($size);
        } else {
            return 'https://ювелирочка.рф/upload/review/no_avatar.png';//todo
        }
    }

    public function getLogo(string $size = ''): string
    {
        if ($this->logoImage !== null) {
            return $this->logoImage->getUrl($size);
        } else {
            return $this->getAvatar($size);
        }
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
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

    public function getLastActivityAttribute()
    {
        return Cache::get("user-$this->id-last-activity");
    }

    public function getLastSeenAttribute()
    {
        return 'Last seen ' . ($this->last_activity !== null ? Carbon::parse($this->last_activity)->diffForHumans() : 'a long time ago');
    }

    public function getIsOnlineAttribute()
    {
        if ($this->last_activity) {
            return Carbon::parse($this->last_activity)->diffInMinutes() < 5;
        }
        return false;
    }

    public function getIsFollowingAttribute()
    {
        return is_following($this);
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        $attributes['avatar'] = $this->avatar;
        $attributes['logo'] = $this->getLogo();
        $attributes['likes_count'] = $this->likes_count;
        $attributes['dislikes_count'] = $this->dislikes_count;

        return $attributes;
    }
}

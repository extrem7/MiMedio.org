<?php

namespace App\Models;

use App\Traits\FollowableTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use FollowableTrait;
    use HasMediaTrait;

    protected $fillable = [
        'name', 'email', 'provider', 'provider_id', 'password',
    ];

    // protected $with = ['image'];

    protected $appends = ['has_password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function playlist()
    {
        return $this->hasOne(Playlist::class);
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'model');
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
        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function getAvatar(string $size = ''): string
    {
        if ($this->getMedia('avatar')->isNotEmpty()) {
            return $this->getFirstMediaUrl('avatar', $size);
        } else {
            return 'http://gimnazija.com.ua/wp-content/uploads/2017/03/no-avatar-300x300.png';//todo
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
        if ($this->image !== null) {
            return $this->image->getFullUrl();
        } else {
            return 'http://gimnazija.com.ua/wp-content/uploads/2017/03/no-avatar-300x300.png';//todo
        }
    }

    public function getLinkAttribute()
    {
        return route('users.show', $this->id);
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        $attributes['avatar'] = $this->avatar;

        return $attributes;
    }
}

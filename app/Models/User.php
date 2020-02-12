<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasMediaTrait;

    protected $fillable = [
        'name', 'email', 'provider', 'provider_id', 'password',
    ];

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('icon')
            ->width(68)
            ->height(68)
            ->sharpen(0);
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

    public function getVideosAttribute(): array
    {
        if ($this->playlist) {
            return $this->playlist->videos ?? [];
        }
        return [];
    }
}

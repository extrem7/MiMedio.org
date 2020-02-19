<?php


namespace App\Traits;


use App\Models\Like;

trait LikeableTrait
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable')->where('dislike', '=', false);
    }

    public function dislikes()
    {
        return $this->morphMany(Like::class, 'likeable')->where('dislike', '=', true);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->dislikes->count();
    }

    public function getCurrentLikeAttribute()
    {
        if ($this->likes->first()) {
            return 'like';
        }
        if ($this->dislikes->first()) {
            return 'dislike';
        }
        return null;
    }

    public function getInitialLikesAttribute()
    {
        return $this->likes->count();
    }

    public function getInitialDislikesAttribute()
    {
        return $this->dislikes->count();
    }
}

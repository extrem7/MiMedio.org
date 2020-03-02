<?php


namespace App\Traits;


use App\Models\Like;
use Auth;

trait LikeableTrait
{
    public function likesRaw()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function likes()
    {
        return $this->likesRaw->where('dislike', '=', false);
    }

    public function dislikes()
    {
        return $this->likesRaw->where('dislike', '=', true);
    }

    public function getRawLikesAttribute()
    {
        return $this->likesRaw->where('dislike', '=', false);
    }

    public function getRawDislikesAttribute()
    {
        return $this->likesRaw->where('dislike', '=', true);
    }

    public function getLikesCountAttribute()
    {
        return $this->rawLikes->count();
    }

    public function getDislikesCountAttribute()
    {
        return $this->rawDislikes->count();
    }

    public function getCurrentLikeAttribute()
    {
        $id = Auth::id();
        if ($this->rawLikes->where('user_id', '=', $id)->first()) {
            return 'like';
        }
        if ($this->rawDislikes->where('user_id', '=', $id)->first()) {
            return 'dislike';
        }
        return null;
    }
}

<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\LikeableTrait;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements Likeable
{
    use LikeableTrait;

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'text'];

    protected $with = ['author'];

    protected $appends = ['date'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function toArray()
    {
        $attributes = parent::toArray();

        $attributes['initial_likes'] = $this->initial_likes;
        $attributes['initial_dislikes'] = $this->initial_dislikes;
        $attributes['current_like'] = $this->current_like;
        $attributes['children'] = [];

        return $attributes;
    }
}

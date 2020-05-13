<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\LikeableTrait;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Comment extends Model implements Likeable
{
    use LikeableTrait;
    use HasEagerLimit;

    protected $fillable = ['user_id', 'post_id', 'parent_id', 'text'];

    protected $with = ['author', 'children'];

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

        $attributes['initial_likes'] = $this->likes_count;
        $attributes['initial_dislikes'] = $this->dislikes_count;
        $attributes['current_like'] = $this->current_like;
        if ($this->children->count() == 0) {
            $attributes['children'] = [];
        }

        return $attributes;
    }
}

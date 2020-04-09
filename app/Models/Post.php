<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\LikeableTrait;
use App\Traits\PaginateTrait;
use App\Traits\SearchTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia, Likeable
{
    use HasMediaTrait;
    use Sluggable;
    use LikeableTrait;
    use PaginateTrait;
    //use Searchable;
    use SearchTrait;

    public const DRAFT = 'DRAFT';
    public const PUBLISHED = 'PUBLISHED';

    public static $statuses = [self::DRAFT, self::PUBLISHED];

    public static $statusesEn = [
        self::DRAFT => 'Draft',
        self::PUBLISHED => 'Publish'
    ];

    protected $fillable = ['category_id', 'title', 'excerpt', 'body', 'status'];

    //protected $with = ['likes', 'dislikes'];

    protected $appends = [
        'date_dots',
        'likes_count',
        'dislikes_count',
        'current_like',
        'thumbnail',
        'link',
        'comments_count',
        'has_comments',
        'share_links'
    ];

    protected $orderBy = 'id';
    protected $orderDirection = 'desc';

    // relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'model');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function related()
    {
        return $this->author->posts()->where('id', '!=', $this->id)->take(3);
    }

    public function newQuery($ordered = true)
    {
        $query = parent::newQuery();

        if (empty($ordered)) {
            return $query;
        }

        return $query->orderBy($this->orderBy, $this->orderDirection);
    }

    //scopes

    /**
     * Scope a query to only published posts.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', '=', self::PUBLISHED);
    }

    //media
    public function registerMediaCollections()
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function uploadImage(UploadedFile $image = null)
    {
        $this->addMedia($image)->toMediaCollection('image');
    }

    //methods
    public function setFeatured($featured)
    {
        $this->featured = (bool)$featured;
    }

    public function setStatus($status = false)
    {
        $this->status = $status ? self::PUBLISHED : self::DRAFT;
    }

    public function view()
    {
        if (!session()->has('viewed') || (session()->has('viewed') && !in_array($this->id, session()->get('viewed')))) {
            $this->increment('views');
            $this->save();
            session()->push('viewed', $this->id);
            session()->save();
        }
    }

    //traits
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
                'unique' => false
            ]
        ];
    }

    //mutate/get
    public function getDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function getDateDotsAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }

    public function getHasCommentsAttribute()
    {
        return $this->comments->count() !== 0;
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments->count();
    }

    public function getBaseCommentsAttribute()
    {
        return $this->comments()->where('parent_id', '=', null)->get();
    }

    public function getLastCommentsAttribute()
    {
        return $this->comments->sortByDesc('id')->take(3);
    }

    public function getThumbnailAttribute()
    {
        if ($this->image !== null) {
            return $this->image->getFullUrl();
        } else {
            return 'https://archive.org/download/no-photo-available/no-photo-available.png';//todo
        }
    }

    public function getLinkAttribute()
    {
        return route('posts.show', [
            'user' => $this->author->slug ?? $this->author->id,
            'slug' => $this->slug
        ]);
    }

    public function getShareLinksAttribute()
    {
        return share_buttons($this->link);
    }

}

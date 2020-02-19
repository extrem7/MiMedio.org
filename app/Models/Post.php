<?php

namespace App\Models;

use App\Interfaces\Likeable;
use App\Traits\LikeableTrait;
use App\Traits\PaginateTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia, Likeable
{
    use HasMediaTrait;
    use Sluggable;
    use LikeableTrait;
    use PaginateTrait;

    public const DRAFT = 'DRAFT';
    public const PUBLISHED = 'PUBLISHED';

    public static $statuses = [self::DRAFT, self::PUBLISHED];

    public static $statusesEn = [
        self::DRAFT => 'Draft',
        self::PUBLISHED => 'Publish'
    ];

    protected $fillable = ['category_id', 'title', 'excerpt', 'body', 'status'];

    //protected $with = ['likes', 'dislikes'];

    protected $appends = ['likes', 'dislikes'];

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
        return $this->author->posts()->where('id', '!=', $this->id);
    }

    public function newQuery($ordered = true)
    {
        $query = parent::newQuery();

        if (empty($ordered)) {
            return $query;
        }

        return $query->orderBy($this->orderBy, $this->orderDirection);
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
                'onUpdate' => false,
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
        return $this->comments->count();
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
        return $this->comments()->orderBy('id', 'desc')->take(3)->get();
    }

    public function getLinkAttribute()
    {
        return route('posts.show', $this->slug);
    }

}

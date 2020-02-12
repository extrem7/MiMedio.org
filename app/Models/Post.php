<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Str;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $category_id
 * @property int $author_id
 * @property string $title
 * @property string $excerpt
 * @property string $body
 * @property string|null $image
 * @property string $slug
 * @property string $status
 * @property int $featured
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereExcerpt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    use Sluggable;

    public const DRAFT = 'DRAFT';
    public const PUBLISHED = 'PUBLISHED';

    protected $fillable = ['title', 'excerpt', 'body'];

    protected $with = ['author', 'likes', 'image'];

    // relations
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable')->where('dislike', '=', false);
    }

    public function dislikes()
    {
        return $this->morphMany(Like::class, 'likeable')->where('dislike', '=', true);
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'model');
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

    public function getLikesAttribute()
    {
        return $this->likes()->count();
    }

    public function getDislikesAttribute()
    {
        return $this->dislikes()->count();
    }

    public function getCurrentLikeAttribute()
    {
        if ($this->likes()->first()) {
            return 'like';
        }
        if ($this->dislikes()->first()) {
            return 'dislike';
        }
        return null;
    }

}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $incrementing = false;

    protected $fillable = ['videos', 'user_id'];

    protected $casts = [
        'videos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $incrementing = false;

    protected $fillable = ['user_id', 'title', 'videos'];

    protected $casts = [
        'videos' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

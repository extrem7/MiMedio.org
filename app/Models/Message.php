<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    protected $appends = ['date', 'date_diff', 'day'];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('H:i');
    }

    public function getDateDiffAttribute()
    {
        if ($this->created_at->diffInHours() >= 1) {
            return $this->created_at->diffForHumans();
        } else {
            return $this->created_at->format('H:i');
        }
    }

    public function getDayAttribute()
    {
        return $this->created_at->format('d F');
    }
}

<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InstagramToken extends Model
{
    public const CREATED_AT = null;
    public const UPDATED_AT = null;

    protected $table = 'channel_instagram_tokens';

    protected $primaryKey = 'channel_id';

    protected $fillable = ['token', 'expires_at'];

    protected $dates = ['expires_at'];

    public function getIsActualAttribute(): bool
    {
        return $this->expires_at->greaterThan(Carbon::now());
    }
}

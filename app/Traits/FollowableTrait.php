<?php


namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait FollowableTrait
{
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id');
    }

    private function follow(User $user): void
    {
        $this->followings()->attach($user);
    }

    private function unfollow(User $user): void
    {
        $this->followings()->detach($user);
    }

    public function toggleFollow(User $user): bool
    {
        $following = $this->isFollowing($user);

        if (!$following) {
            $this->follow($user);
            $following = true;
        } else {
            $this->unfollow($user);
            $following = false;
        }
        return $following;
    }

    public function isFollowing(User $user): bool
    {
        return $this->followings->contains('id', $user->id);
    }

    public function isFollowed(User $user): bool
    {
        return $this->followers->contains('id', $user->id);
    }
}

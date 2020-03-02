<?php


namespace App\Services;

use App\Interfaces\Likeable;
use Auth;

class LikesService
{

    public function toggle(Likeable $likeable, bool $makeLike = true)
    {
        $user_id = Auth::getUser()->id;
        $active = true;

        $good = null;
        $bad = null;

        $initial = $this->getInitialData($likeable, $user_id);
        $like = $initial['like'];
        $dislike = $initial['dislike'];

        if ($makeLike) {
            $good = $like;
            $bad = $dislike;
        } else {
            $good = $dislike;
            $bad = $like;
        }
        if ($good === null) {
            $likeable->likesRaw()->create([
                'user_id' => Auth::getUser()->id,
                'dislike' => !$makeLike
            ]);
            if ($bad) {
                $bad->delete();
            }
        } else {
            $good->delete();
            $active = false;
        }
        return [
            'active' => $active
        ];
    }

    private function getInitialData(Likeable $likeable, int $user_id)
    {
        $like = $likeable->likes()->where('user_id', '=', $user_id)->first();
        $dislike = $likeable->dislikes()->where('user_id', '=', $user_id)->first();
        return compact('like', 'dislike');
    }
}

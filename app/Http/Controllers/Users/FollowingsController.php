<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;

class FollowingsController extends Controller
{
    public function __invoke(User $user)
    {
        $following = Auth::getUser()->toggleFollow($user);

        return response()->json([
            'status' => 'ok',
            'following' => $following,
            'followers' => $user->followers()->count()
        ]);
    }
}

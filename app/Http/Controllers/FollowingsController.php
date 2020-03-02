<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

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

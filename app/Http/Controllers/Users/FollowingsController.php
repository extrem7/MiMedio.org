<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class FollowingsController extends Controller
{
    public function __invoke(User $user): JsonResponse
    {
        $following = \Auth::user()->toggleFollow($user);

        return response()->json([
            'status' => 'ok',
            'following' => $following,
            'followers' => $user->followers()->count()
        ]);
    }
}

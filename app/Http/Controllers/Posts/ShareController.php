<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Share;
use Illuminate\Http\JsonResponse;

class ShareController extends Controller
{
    public function __invoke(Post $post): JsonResponse
    {
        $user = \Auth::user();

        if ($old = $user->shared()->where('post_id', '=', $post->id)->first()) {
            $old->delete();
        }

        \Auth::user()->shared()->save($post);

        return response()->json(['status' => 'ok']);
    }
}

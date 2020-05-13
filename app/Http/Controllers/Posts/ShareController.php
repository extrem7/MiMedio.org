<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Share;

class ShareController extends Controller
{
    public function __invoke(Post $post)
    {
        $old = Share::where('user_id', auth()->id())->where('post_id', $post->id)->first();
        if ($old !== null) {
            $old->delete();
        }

        $shared = new Share(['user_id' => auth()->id(), 'post_id' => $post->id]);
        $shared->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }
}

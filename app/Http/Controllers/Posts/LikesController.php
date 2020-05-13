<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\LikesService;

class LikesController extends Controller
{

    public function like(Post $post, LikesService $likesService)
    {
        $data = $likesService->toggle($post);

        return response()->json(array_merge([
            'status' => 'ok'
        ], $data));
    }

    public function dislike(Post $post, LikesService $likesService)
    {
        $data = $likesService->toggle($post, false);

        return response()->json(array_merge([
            'status' => 'ok'
        ], $data));
    }
}

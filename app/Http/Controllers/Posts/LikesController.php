<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\LikesService;
use Illuminate\Http\JsonResponse;

class LikesController extends Controller
{
    protected LikesService $likesService;

    public function __construct()
    {
        parent::__construct();

        $this->likesService = app(LikesService::class);
    }

    public function like(Post $post): JsonResponse
    {
        $data = $this->likesService->toggle($post);

        return response()->json(array_merge(['status' => 'ok'], $data));
    }

    public function dislike(Post $post): JsonResponse
    {
        $data = $this->likesService->toggle($post, false);

        return response()->json(array_merge(['status' => 'ok'], $data));
    }
}

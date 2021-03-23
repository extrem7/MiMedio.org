<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Services\LikesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{
    public function index(Post $post): JsonResponse
    {
        $count = $post->comments->count();
        $comments = $post->comments->whereNull('parent_id');

        return response()->json(compact('count', 'comments'));
    }

    public function store(Post $post, Request $request): JsonResponse
    {
        $this->validate($request, [
            'text' => 'required',
            'reply' => 'nullable|exists:comments,id'
        ]);

        $data = [
            'user_id' => auth()->id(),
            'text' => $request->input('text')
        ];

        if ($request->filled('reply')) {
            $data['parent_id'] = $request->input('reply');

            if (!$post->comments->contains($data['parent_id'])) {
                throw ValidationException::withMessages([
                    'reply' => 'Provide real reply to.',
                ]);
            }
        }

        $comment = $post->comments()->create($data);
        $comment->setRelation('author', \Auth::user());

        return response()->json([
            'status' => 'ok',
            'comment' => $comment,
        ], 201);
    }

    public function like(int $id, LikesService $likesService): JsonResponse
    {
        $comment = Comment::without(['children', 'author'])->find($id);
        $data = $likesService->toggle($comment);

        return response()->json(array_merge(['status' => 'ok'], $data));
    }

    public function dislike(int $id, LikesService $likesService): JsonResponse
    {
        $comment = Comment::without(['children', 'author'])->find($id);
        $data = $likesService->toggle($comment, false);

        return response()->json(array_merge(['status' => 'ok'], $data));
    }
}

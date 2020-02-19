<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\LikesService;
use Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'reply' => 'nullable|exists:comments,id'
        ]);

        $user_id = Auth::getUser()->id;

        $data = [
            'user_id' => Auth::getUser()->id,
            'text' => $request->input('text')
        ];
        if ($request->has('reply')) $data['parent_id'] = $request->input('reply');

        $comment = $post->comments()->create($data);
        $comment->author = Auth::getUser();

        return response()->json([
            'status' => 'ok',
            'comment' => $comment,
        ]);
    }

    public function like(Comment $comment, LikesService $likesService)
    {
        $data = $likesService->toggle($comment);

        return response()->json(array_merge([
            'status' => 'ok'
        ], $data));
    }

    public function dislike(Comment $comment, LikesService $likesService)
    {
        $data = $likesService->toggle($comment, false);

        return response()->json(array_merge([
            'status' => 'ok'
        ], $data));
    }
}

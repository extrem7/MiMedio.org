<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\PostsBaseController;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Services\LikesService;
use Auth;

class PostsController extends PostsBaseController
{
    public function index(int $page = 1)
    {
        $this->meta->prependTitle('Latest news');

        $categories = $this->postsService->getCategories();

        $posts = $this->postsService->getPosts(null, $page);

        return view('posts.index', compact('categories', 'posts'));
    }

    public function create()
    {
        $this->meta->prependTitle('Create post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.create', compact('categories', 'statuses'));
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        if ($data['excerpt'] === null) {
            $data['excerpt'] = substr($data['body'], 0, 140);
        }

        $post = Auth::getUser()->posts()->create($data);
        $post->save();

        if ($request->hasFile('image')) {
            $post->uploadImage($request->file('image'));
        }

        if ($post) {
            return redirect()->route('posts.edit', [
                'user' => $post->author->id,
                'slug' => $post->slug
            ])->with('status', 'Post has been updated');
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    public function show(User $user, string $slug)
    {
        $post = $user->posts()->whereSlug($slug)->firstOrFail();

        if ($post->status !== Post::PUBLISHED) {
            if (!Auth::check() || Auth::id() !== $post->author->id) {
                abort(403);
            }
        }

        $this->meta->prependTitle($post->title);

        $post->view();

        $playlist = $post->author->playlist;

        $related = $this->postsService->getRelated($post);

        return view('posts.show', compact('post', 'playlist', 'related'));
    }

    public function edit(Post $post)
    {
        $this->meta->prependTitle('Edit post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.edit', compact('post', 'categories', 'statuses'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if ($data['excerpt'] === null) {
            $data['excerpt'] = substr($data['body'], 0, 140);
        }

        $post->fill($data);
        $post->save();

        if ($request->hasFile('image')) {
            $post->uploadImage($request->file('image'));
        }

        if ($post) {
            return redirect()->back()->with('status', 'Post has been updated');
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    public function destroy(Post $post)
    {
        $post->delete();
    }

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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Services\LikesService;
use Auth;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $page = 1)
    {
        $this->meta->prependTitle('Your posts');

        $user = Auth::getUser();

        $posts = $user->posts()->with(['author', 'image', 'comments' => function (Relation $query) {
            $query->setEagerLoads([]);
        }])->paginateUri(1, $page);

        return view('profile.posts', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->meta->prependTitle('Create post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.create', compact('categories', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('posts.show', $post->slug);
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($param)
    {
        $post = Post::with(['author.playlist', 'author.posts', 'image', 'comments.likes', 'comments.dislikes'])
            ->where('id', $param)
            ->orWhere('slug', $param)
            ->firstOrFail();

        $this->meta->prependTitle($post->title);

        $post->view();

        $playlist = $post->author->playlist;

        return view('posts.show', compact('post', 'playlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->meta->prependTitle('Edit post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.edit', compact('post', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('posts.show', $post->slug);
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

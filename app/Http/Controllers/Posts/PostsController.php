<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\PostsBaseController;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Share;
use App\Models\User;
use App\Services\LikesService;
use Auth;
use Illuminate\Http\Request;
use Str;

class PostsController extends PostsBaseController
{
    public function index(int $page = 1)
    {
        $this->meta->prependTitle('Latest news');

        $categories = $this->postsService->getCategories();

        $posts = $this->postsService->getPosts(null, $page);

        return view('posts.index', compact('categories', 'posts'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string'
        ]);

        $query = $request->get('query');

        $this->meta->prependTitle($query . ' - Search results');

        $posts = $this->postsService->search($query);

        return view('posts.search', compact('posts', 'query'));
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
            return redirect()->route('posts.edit', $post->id)->with('status', 'Post has been updated');
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    public function image(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,bmp,png',
        ]);

        $image = $request->file('image');
        $name = Str::random(25);
        $file = $image->storeAs('public/uploads', $name . '.' . $image->getClientOriginalExtension());

        return ['location' => \Storage::url($file)];
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

        $related = $this->postsService->getRelated($post);

        return view('posts.show', compact('post', 'related'));
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
        return redirect()->back()->with('status', 'Post has been deleted');
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

    public function share(Post $post)
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts = Post::with('author', 'category')->get();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $post = new Post();

        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $post = new Post($data);
        $post->author_id = 1;

        if ($data['slug']) {
            $slug = Str::slug($data['slug']);
            if (Post::where('slug', $slug)->count() == 0) $post->slug = $slug;
        }

        $post->setCategory($data['category_id']);
        $post->setFeatured($data['featured'] ?? null);
        $post->setStatus($data['status'] ?? false);
        $post->uploadImage($request->image);
        $post->save();

        if ($post) {
            return redirect()->route('posts.index')
                ->with('status', "Post `$post->title` has been created");
        } else {
            return back()->withErrors('msg', "Error")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->input();

        $post->fill($data);

        $slug = Str::slug($data['slug']);

        if (Post::where('slug', $slug)->count() == 0) $post->slug = $slug;

        $post->setCategory($data['category_id']);
        $post->setFeatured($data['featured'] ?? 0);
        $post->setStatus($data['status'] ?? false);
        $post->uploadImage($request->image);
        $post->save();

        return redirect()->route('posts.index')
            ->with('status', "Post `$post->title` has been edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with('status', "Post `$post->title` has been removed");
    }
}

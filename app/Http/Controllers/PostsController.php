<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('profile.posts.create', compact('categories'));
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
        $post = Post::where('id', $param)
            ->orWhere('slug', $param)
            ->firstOrFail();

        $post->view();

        return view('profile.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function like(Post $post)
    {
        $user_id = Auth::getUser()->id;
        $active = true;

        $like = $post->likes()->where('user_id', '=', $user_id)->first();
        $dislike = $post->dislikes()->where('user_id', '=', $user_id)->first();
        if ($like === null) {
            $post->likes()->create([
                'user_id' => Auth::getUser()->id
            ]);
            if ($dislike) {
                $dislike->delete();
            }
        } else {
            $like->delete();
            $active = false;
        }
        return response()->json([
            'status' => 'ok',
            'likes' => $post->likes,
            'dislikes' => $post->dislikes,
            'active' => $active
        ]);
    }

    public function dislike(Post $post)
    {
        $user_id = Auth::getUser()->id;
        $active = true;

        $dislike = $post->dislikes()->where('user_id', '=', $user_id)->first();
        $like = $post->likes()->where('user_id', '=', $user_id)->first();
        if ($dislike === null) {
            $post->dislikes()->create([
                'user_id' => Auth::getUser()->id,
                'dislike' => true
            ]);
            if ($like) {
                $like->delete();
            }
        } else {
            $dislike->delete();
            $active = false;
        }
        return response()->json([
            'status' => 'ok',
            'likes' => $post->likes,
            'dislikes' => $post->dislikes,
            'active' => $active
        ]);
    }
}

<?php

namespace App\Http\Controllers\Posts;

use App\Http\Requests\PostRequest;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class PostsController extends BaseController
{
    /* @return View|LengthAwarePaginator<Post> */
    public function index()
    {
        $posts = $this->postsService->getPosts();

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle('Latest news');

        $categories = $this->postsService->getCategories();

        share(compact('posts'));

        return view('posts.index', compact('categories', 'posts'));
    }

    public function create(): View
    {
        $this->meta->prependTitle('Create post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.create', compact('categories', 'statuses'));
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($data['excerpt'] === null) {
            $body = strip_tags($data['body'], ['p', 'b', 'i']);
            $data['excerpt'] = substr($body, 0, 140);
        }

        $post = \Auth::user()->posts()->create($data);
        $post->save();

        if ($request->hasFile('image')) {
            $post->uploadImage($request->file('image'));
        }

        return redirect()
            ->route('posts.edit', $post->id)
            ->with('status', __('mimedio.profile.post.created'));
    }

    public function show(User $user, Post $post): View
    {
        $og = new OpenGraphPackage('facebook');
        $og->setType('article')
            ->setTitle($post->title)
            ->setDescription(strip_tags($post->excerpt))
            ->addImage($post->thumbnail)
            ->setUrl($post->link);
        $this->meta->registerPackage($og);

        $twitterCard = new TwitterCardPackage('twitter');
        $twitterCard->setType('summary')
            ->setSite('@el_ciudadano')
            ->setTitle($post->title)
            ->setDescription(strip_tags($post->excerpt))
            ->setImage($post->thumbnail)
            ->addMeta('url', $post->link);
        $this->meta->registerPackage($twitterCard);

        $this->meta->prependTitle($post->title);

        $post->view();

        $related = $this->postsService->getRelated($post);

        return view('posts.show', compact('post', 'related'));
    }

    public function edit(Post $post): View
    {
        $this->meta->prependTitle('Edit post');

        $categories = Category::pluck('name', 'id')->all();
        $statuses = Post::$statusesEn;

        return view('posts.edit', compact('post', 'categories', 'statuses'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $request->validated();

        if ($data['excerpt'] === null) {
            $body = strip_tags($data['body'], ['p', 'b', 'i']);
            $data['excerpt'] = substr($body, 0, 140);
        }

        $post->fill($data);
        $post->save();

        if ($request->hasFile('image')) {
            $post->uploadImage($request->file('image'));
        }

        return back()->with('status', __('mimedio.profile.post.updated'));
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return response()->json(null, 204);
    }
}

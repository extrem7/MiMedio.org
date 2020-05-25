<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

class PostsService
{
    public function getPosts($relation = null, bool $paginate = true)
    {
        if ($relation == null) {
            $relation = Post::published();
        } elseif (!navIsRoute('profile.posts.index')) {
            $relation = $relation->published();
        }

        $relation = $this->eagerLoad($relation);

        if ($paginate === true) {
            $page = request()->get('page') ?? 1;
            $per_page = $this->perPage();
            $posts = $relation->paginate($per_page, $page);
            if ($posts->count() === 0 && navIsRoute('profile.posts.index')) abort(404);
        } else {
            return $relation->get();
        }

        return $posts;
    }

    public function getHomeTimeLine()
    {
        return $this->getPosts();
    }

    public function search(string $query)
    {
        $posts = $this->eagerLoad(Post::published()->search($query))->paginate($this->perPage());

        return $posts;
    }

    public function getCategories()
    {
        return Category::pluck('name', 'slug');
    }

    public function getShared(User $user, bool $eagerLoad = true)
    {
        return $this->getPosts($user->shared(), false);
    }

    public function getUserCategories(User $user, bool $eagerLoad = true)
    {
        $c = Category::whereHas('posts', function ($query) use ($user) {
            return $query->published()->whereUserId($user->id);
        })->with(['posts' => function ($query) use ($user) {
            $query->published()->whereUserId($user->id)->limit(6);
        }])->get();

        $categories = Category::all();
        $query = null;
        $categoriesWithPosts = [];

        foreach ($categories as $item) {
            $query = $user->posts()
                ->published()
                ->where('category_id', '=', $item->id);
            if ($eagerLoad) {
                $query = $this->eagerLoad($query);
            }

            $postsInCategory = $query->take(6)->get();
            if ($postsInCategory->isNotEmpty())
                $categoriesWithPosts[$item->id] = (object)[
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'posts' => $postsInCategory,
                    'load_more' => $query->count() > 6
                ];
        };

        return $categoriesWithPosts;
    }

    public function getRelated(Post $post)
    {
        $posts = $post->author
            ->posts()
            ->with(['author', 'image'])
            ->where('id', '!=', $post->id)
            ->take(3);
        return $posts->get();
    }

    private function eagerLoad($relation)
    {
        $relation->with([
            'author',
            'image',
        ])->withCount('comments');
        if (!(navIsRoute('users.show') || navIsRoute('users.show.posts'))) {
            $relation->with([
                'author.avatarImage',
                'author.logoImage',
                'likesRaw',
                'comments' => function (Relation $query) {
                    $query->setEagerLoads([])
                        ->with('author', 'likesRaw')
                        ->orderByDesc('id')
                        ->limit(3);
                }
            ]);
        }
        if (!navIsRoute('home')) {
            $relation->with('author.followers');
        }
        return $relation;
    }

    public function perPage()
    {
        if (navIsRoute('users.show.category')) {
            return 6;
        }
        if (navIsRoute('profile.posts.index')) {
            return 8;
        }
        return config('mimedio.posts_per_page');
    }
}

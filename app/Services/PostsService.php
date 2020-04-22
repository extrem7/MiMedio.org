<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

class PostsService
{
    public function getPosts($relation = null, int $page = 1, int $per_page = null, bool $paginate = true, bool $abort = false, bool $published = true)
    {
        if ($relation == null) {
            $relation = Post::query();
        }

        $relation = $this->eagerLoad($relation);
        if ($published) {
            $relation = $relation->published();
        }

        if ($paginate) {
            if ($per_page == null) {
                $per_page = $this->perPage();
            }
            $posts = $relation->paginateUri($per_page, $page);
        } else {
            $posts = $relation->get();
        }

        if ($paginate && $posts->count() == 0 && $abort) {
            abort(404);
        }

        return $posts;
    }

    public function getHomeTimeLine(int $page = 1)
    {
        return $this->getPosts(Post::query(), $page, 6);
    }

    public function search(string $query)
    {
        $posts = $this->eagerLoad(Post::published()->search($query))
            ->paginate($this->perPage());
        return $posts;
    }

    public function getCategories()
    {
        return Category::pluck('name', 'slug');
    }

    public function getShared(User $user, bool $eagerLoad = true)
    {
        return $this->getPosts($user->shared(), 0, 0, false, false);
    }

    public function getUserCategories(User $user, bool $eagerLoad = true)
    {
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
        return $relation->with([
            'author',
            'author.followers',
            'author.avatarImage',
            'likesRaw',
            'image',
            'comments' => function (Relation $query) {
                $query->setEagerLoads([])->with('author', 'likesRaw')->take(3);
            }
        ])->withCount('comments');
    }

    public function perPage()
    {
        return config('mimedio.posts_per_page');
    }
}

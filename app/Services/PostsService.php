<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;

class PostsService
{
    public function getPosts(Relation $relation = null, int $page = 1, int $per_page = null, bool $paginate = true, bool $abort = true)
    {
        if ($relation == null) {
            $relation = Post::query();
        }

        $relation = $this->eagerLoad($relation)->published();

        if ($paginate) {
            if ($per_page == null) {
                $per_page = config('mimedio.posts_per_page');
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

    public function getCategories()
    {
        return Category::pluck('name', 'slug');
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
                    'posts' => $postsInCategory
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
            'author.followers',
            'author.image',
            'likesRaw',
            'image',
            'comments' => function (Relation $query) {
                $query->setEagerLoads([]);
            }
        ]);
    }
}

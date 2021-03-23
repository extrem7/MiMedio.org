<?php

namespace App\Http\Controllers\Posts;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    /* @return View|LengthAwarePaginator<Post> */
    public function __invoke(Request $request)
    {
        ['query' => $query] = $this->validate($request, [
            'query' => ['required', 'string']
        ]);

        $posts = $this->postsService->search($query);

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle($query . ' - Search results');

        share(compact('query', 'posts'));

        return view('posts.search', compact('query'));
    }
}

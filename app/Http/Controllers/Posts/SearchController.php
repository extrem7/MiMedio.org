<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|string'
        ]);

        $query = $request->get('query');

        $posts = $this->postsService->search($query);

        if (request()->expectsJson()) return $posts;

        $this->meta->prependTitle($query . ' - Search results');

        share(compact('query', 'posts'));

        return view('posts.search', compact('query'));
    }
}

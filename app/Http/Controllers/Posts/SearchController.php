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

        $this->meta->prependTitle($query . ' - Search results');

        $posts = $this->postsService->search($query);

        return view('posts.search', compact('posts', 'query'));
    }
}

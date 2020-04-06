<?php

namespace App\Http\Controllers;

use App\Services\PostsService;
use App\Services\RssService;
use Auth;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class HomeController extends Controller
{
    private $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(RssService $rssService)
    {
        $this->meta->prependTitle('Social network');
        $posts = $this->postsService->getPosts();
        $rss = collect($rssService->get())->slice(0, 2);
        if (Auth::check()) {

            if (Auth::user()->saved_media_rss->isNotEmpty()) {
                $rss = $rssService->getForUser();
            }
        }
        return view('home', compact('posts', 'rss'));
    }
}

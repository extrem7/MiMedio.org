<?php

namespace App\Http\Controllers;

use App\Services\RssService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RssController extends Controller
{
    private RssService $rssService;

    public function __construct()
    {
        parent::__construct();

        $this->rssService = app(RssService::class);
    }

    public function index(): View
    {
        $this->meta->prependTitle('News from RedMedial');

        $rssItems = $this->rssService->get();

        share(compact('rssItems'));

        return view('rss.index', compact('rssItems'));
    }

    public function showPost(string $slug): View
    {
        $response = \Http::get(config('mimedio.feeds_api') . "/post/$slug");
        $post = json_decode($response->body(), true, 512, JSON_THROW_ON_ERROR);

        $this->meta->prependTitle($post['title']);

        $post['date'] = Carbon::parse($post['date'])->format('d/m/Y');

        return view('rss.post', compact('post'));
    }

    public function toggle(int $id): ?JsonResponse
    {
        if (!\Auth::user()->channel->saved_rss->contains($id)) {
            return $this->rssService->save($id);
        }

        return $this->rssService->remove($id);
    }

    public function sort(Request $request): JsonResponse
    {
        $this->validate($request, [
            'order' => ['required', 'array'],
            'order.*' => ['numeric']
        ]);

        session(['rss-order' => $request->get('order')]);

        return response()->json(null, 204);
    }
}

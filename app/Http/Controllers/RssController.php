<?php

namespace App\Http\Controllers;

use App\Services\RssService;
use Illuminate\Http\Request;

class RssController extends Controller
{
    private $rssService;

    public function __construct()
    {
        parent::__construct();
        $this->rssService = new RssService();
    }

    public function index()
    {
        $this->meta->prependTitle('News from RedMedial');

        $rssItems = $this->rssService->get();
        share(compact('rssItems'));

        return view('rss.index', compact('rssItems'));
    }

    public function toggle(int $id)
    {
        if (!\Auth::getUser()->channel->saved_rss->contains($id)) {
            return $this->rssService->save($id);
        } else {
            return $this->rssService->remove($id);
        }
    }

    public function sort(Request $request)
    {
        $this->validate($request, [
            'order' => ['required', 'array'],
            'order.*' => ['numeric']
        ]);
        session(['rss-order' => $request->get('order')]);
        return response()->json();
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\RssService;
use Butschster\Head\Contracts\MetaTags\MetaInterface;

class RssController extends Controller
{
    private $rssService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->rssService = new RssService();
    }

    public function index(RssService $rssService)
    {
        $this->meta->prependTitle('News from RedMedial');
        $items = $this->rssService->get();

        return view('rss.index', compact('items'));
    }

    public function add(int $id)
    {
        $items = $this->rssService->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $user = \Auth::user();
                $saved = $user->saved_media_rss;
                if ($saved->count() >= 2) return back()->with('error', 'You can add no more than two medias');
                if (!$saved->contains($id))
                    $saved[] = $id;
                $user->fill(['saved_rss' => $saved->implode(',')]);
                $user->save();
                return back();
            }
        }
        return back()->with('error', 'Good joke');
    }

    public function remove(int $id)
    {
        $items = $this->rssService->get();
        foreach ($items as $item) {
            if ($item->id == $id) {
                $user = \Auth::user();
                $saved = $user->saved_media_rss;

                if ($saved->contains($id))
                    $saved->forget($saved->search($id));

                $user->fill(['saved_rss' => $saved->implode(',')]);
                $user->save();
                return back();
            }
        }
        return back()->with('error', 'Good joke');
    }
}

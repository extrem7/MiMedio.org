<?php

namespace App\Http\Controllers;

use App\Services\RssService;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class RssController extends Controller
{
    public function index(RssService $rssService)
    {
        $items = $rssService->get();

        return view('rss.index', compact('items'));
    }

    public function add(int $id)
    {

    }

    public function remove(int $id)
    {

    }
}

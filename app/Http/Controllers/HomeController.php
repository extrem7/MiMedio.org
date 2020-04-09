<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
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
        $posts = $this->postsService->getPosts(null, 1, 6);
        $rss = collect($rssService->get())->slice(0, 2);
        $chats = [];
        $followings = [];

        if (Auth::check()) {

            if (Auth::user()->saved_media_rss->isNotEmpty()) {
                $rss = $rssService->getForUser();
            }

            $chats = User::whereHas('messages', function ($query) {
                $query->where('to', '=', auth()->id());
            })->get();

            $chats = $chats->map(function ($chat) {
                $chat->last = Message::whereIn('from', [$chat->id, auth()->id()])
                    ->whereIn('to', [$chat->id, auth()->id()])
                    ->orderBy('id', 'desc')
                    ->first();
                return $chat;
            })->sortBy(function ($chat) {
                return $chat->last->id;
            })->reverse();

            $followings = Auth::user()->followings;
        }

        return view('pages.home', compact('posts', 'rss', 'followings', 'chats'));
    }

    public function posts(int $page = 1)
    {
        $posts = $this->postsService->getPosts(null, $page, 6);
        return $posts;
    }

    public function messenger(User $user = null)
    {
        $this->meta->prependTitle('Messenger');

        if ($user) {
            share([
                'chat' => $user->id
            ]);
        }

        $contacts = User::where('id', '!=', auth()->id())->get();

        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', auth()->id())
            ->where('read', false)
            ->groupBy('from')
            ->get();
        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            $contact->last = Message::whereIn('from', [$contact->id, auth()->id()])
                ->whereIn('to', [$contact->id, auth()->id()])
                ->orderBy('id', 'desc')
                ->first();
            return $contact;
        });

        return view('pages.messenger', compact('contacts'));
    }
}

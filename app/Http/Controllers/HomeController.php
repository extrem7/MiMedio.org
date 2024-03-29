<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Services\MessengerService;
use App\Services\PostsService;
use App\Services\RssService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    private PostsService $postsService;

    public function __construct()
    {
        parent::__construct();

        $this->postsService = app(PostsService::class);
    }

    /* @return View|LengthAwarePaginator */
    public function index(RssService $rssService, MessengerService $messengerService)
    {
        $posts = $this->postsService->getHomeTimeLine();

        if (request()->expectsJson()) {
            return $posts;
        }

        $this->meta->prependTitle('Social network');
        $rss = collect($rssService->get())->slice(0, 2);
        $chats = [];
        $followings = [];

        if ($user = \Auth::user()) {

            if ($user->channel->saved_rss->isNotEmpty()) {
                $rss = $rssService->getForUser();
            }

            $chats = $messengerService->getChats();

            $user->load('followings.avatarImage');
            $followings = $user->followings;
        }

        share([
            'posts' => $posts
        ]);

        return view('pages.home', compact('rss', 'followings', 'chats'));
    }

    public function messenger(MessengerService $messengerService, User $user = null): View
    {
        $this->meta->prependTitle('Messenger');

        if ($user) {
            share([
                'chat' => $user->id
            ]);
        }

        $contacts = $messengerService->getContacts(true);

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

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Post;
use App\Models\User;
use App\Services\MessengerService;
use App\Services\PostsService;
use App\Services\RssService;
use Auth;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Carbon\Carbon;

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
    public function index(RssService $rssService, MessengerService $messengerService)
    {
        $this->meta->prependTitle('Social network');
        $posts = $this->postsService->getHomeTimeLine();
        $rss = collect($rssService->get())->slice(0, 2);
        $chats = [];
        $followings = [];

        if (Auth::check()) {

            if (Auth::user()->saved_media_rss->isNotEmpty()) {
                $rss = $rssService->getForUser();
            }

            $chats = $messengerService->getChats();

            $followings = Auth::user()->followings->map(function ($user) {
                $user->new_posts = Post::published()->whereDate('created_at', Carbon::today())->count();
                return $user;
            });
        }

        return view('pages.home', compact('posts', 'rss', 'followings', 'chats'));
    }

    public function posts(int $page = 1)
    {
        $posts = $this->postsService->getHomeTimeLine($page);
        return $posts;
    }

    public function messenger(User $user = null, MessengerService $messengerService)
    {
        $this->meta->prependTitle('Messenger');

        if ($user) {
            share([
                'chat' => $user->id
            ]);
        }

        $contacts = $messengerService->getContacts();

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

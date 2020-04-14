<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PostsService;
use Auth;
use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Hash;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Polls\Poll;
use Inani\Larapoll\Option;
use Inani\Larapoll\Vote;

class ProfileController extends Controller
{
    private $postsService;

    public function __construct(MetaInterface $meta)
    {
        parent::__construct($meta);
        $this->postsService = new PostsService();
    }

    public function settings()
    {
        $user = Auth::user();
        $avatar = $user->getAvatar();

        $this->meta->prependTitle('Profile settings');
        return view('profile.settings', compact('user', 'avatar'));
    }

    public function settingsUpdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, $this->rulesSettings($user));

        $data = $request->input();

        $fillData = [
            'name' => $data['name']
        ];
        if ($user->has_password) {
            $fillData['email'] = $data['email'];
        }
        $user->fill($fillData);

        if (isset($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatar');
            $user->addMedia($request->file('avatar'))->toMediaCollection('avatar');
        }

        $user->save();

        return redirect()->back()->with('status', 'Profile has been successfully updated.');
    }

    public function channel()
    {
        $user = Auth::user();
        $facebook = null;
        $twitter = null;
        if ($user->embed !== null) {
            $facebook = $user->embed['facebook'] ?? null;
            $twitter = $user->embed['twitter'] ?? null;
        }
        $logo = $user->getLogo();

        $this->meta->prependTitle('Channel settings');
        return view('profile.channel', compact('user', 'facebook', 'twitter', 'logo'));
    }

    public function channelUpdate(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'slug' => 'nullable|string|min:3|unique:users,slug,' . $user->id,
            'embed' => 'nullable|array',
            'embed.*' => 'nullable|string',
            'logo' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,bmp,png'],
            'color' => 'nullable|string|size:6'
        ]);

        $data = $request->input();
        if ($data['color'] == '2c95d8') unset($data['color']);

        $user->fill($data);

        if ($request->hasFile('logo')) {
            $user->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        $user->save();

        return redirect()->back()->with('status', 'Channel has been successfully updated.');
    }

    public function posts(int $page = 1)
    {
        $this->meta->prependTitle('My posts');

        $user = Auth::getUser();

        $posts = $this->postsService->getPosts($user->posts(), $page, 6, true, false,false);

        return view('profile.posts', compact('posts'));
    }

    public function playlist()
    {
        $playlist = Auth::getUser()->playlist;
        if ($playlist !== null)
            $videos = $playlist->videos;
        if (empty($videos)) {
            $videos = [['title' => '', 'id' => '', 'duration' => '']];
        }

        $this->meta->prependTitle('My playlist');
        return view('profile.playlist', compact('playlist', 'videos'));
    }

    public function playlistUpdate(Request $request)
    {
        $user = Auth::user();
        $initial = $request->input('videos')[0];
        if ($initial['title'] == null || $initial['id'] == null) {
            $user->playlist()->delete();
            return redirect()->back();
        }

        $this->validate($request, $this->rulesPlaylist());

        $data = $request->all();

        $user->playlist()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->back();
    }

    public function poll()
    {
        $this->meta->prependTitle('My poll');

        $poll = Auth::getUser()->ownPoll;
        $answers = null;
        if ($poll !== null)
            $answers = $poll->options->pluck('name');

        return view('profile.poll', compact('poll', 'answers'));
    }

    public function pollStore(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string',
            'answers' => 'required|array|min:2',
            'answers.*' => 'required|string|distinct'//write message
        ]);

        $user = Auth::user();
        $data = $request->all();

        $poll = $user->ownPoll()->updateOrCreate(['user_id' => $user->id], [
            'question' => $data['question']
        ]);

        $answers = $data['answers'];
        if ($poll->options->isNotEmpty()) {
            $options = $poll->options->pluck('name');
            $answers = array_filter($answers, function ($answer) use ($options) {
                return !$options->contains($answer);
            });
        }

        if (!empty($answers)) {
            if ($poll->options->isNotEmpty()) {
                $poll->attach($answers);
            } else {
                $poll->addOptions($answers)
                    ->maxSelection()
                    ->generate();
            }
        }

        return redirect()->back();
    }

    public function pollVote(Poll $poll, Request $request)
    {
        $this->validate($request, [
            'options' => 'required|int|exists:larapoll_options,id'
        ]);

        $user = Auth::getUser();

        $option = Option::findOrFail($request->get('options'));
        $user->poll($poll)->vote($option->id);
        $option->updateTotalVotes();

        return redirect()->back();
    }

    public function pollDelete()
    {
        $user = Auth::user();
        $user->ownPoll->delete();
        return redirect()->back();
    }

    private function rulesSettings(User $user)
    {
        $rules = [
            'avatar' => ['nullable', 'image', 'max:2048', 'mimes:jpg,jpeg,bmp,png'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ];
        if ($user->has_password) {
            $rules['email'] = [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id)
            ];
        }
        return $rules;
    }

    private function rulesPlaylist()
    {
        return [
            'title' => 'required|string|max:255',
            'videos.*.title' => ['required'],
            'videos.*.id' => ['required']
        ];
    }
}

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

    public function posts(int $page = 1)
    {
        $this->meta->prependTitle('My posts');

        $user = Auth::getUser();

        $posts = $this->postsService->getPosts($user->posts(), $page, 6);

        $user->posts()->with(['author', 'image', 'comments' => function (Relation $query) {
            $query->setEagerLoads([]);
        }])->paginateUri(1, $page);

        return view('profile.posts', compact('posts'));
    }

    public function playlist()
    {
        $playlist = Auth::getUser()->playlist;
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

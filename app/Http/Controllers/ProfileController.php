<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Auth;
use Butschster\Head\Facades\Meta;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        $avatar = $user->getAvatar();

        Meta::prependTitle('Profile settings');
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

    public function playlist()
    {
        $videos = Auth::getUser()->videos;
        if (empty($videos)) {
            $videos = [['title' => '', 'id' => '', 'duration' => '']];
        }

        Meta::prependTitle('Edit playlist');
        return view('profile.playlist', compact('videos'));
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

        $data = ['videos' => $request->input('videos')];

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
            'videos.*.title' => ['required'],
            'videos.*.id' => ['required']
        ];
    }
}

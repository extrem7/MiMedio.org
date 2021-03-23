<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaylistRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PlaylistController extends Controller
{
    public function page(): View
    {
        $this->meta->prependTitle('My playlist');

        $playlist = \Auth::user()->playlist;
        if ($playlist !== null) {
            $videos = $playlist->videos;
        }
        if (empty($videos)) {
            $videos = [['title' => '', 'id' => '', 'duration' => '']];
        }

        return view('profile.playlist', compact('playlist', 'videos'));
    }

    public function update(PlaylistRequest $request): RedirectResponse
    {
        $user = \Auth::user();

        $initial = $request->input('videos')[0];
        if ($initial['title'] === null || $initial['id'] === null) {
            $user->playlist()->delete();
            return back();
        }

        $data = $request->validated();

        $user->playlist()->updateOrCreate(['user_id' => $user->id], $data);

        return back();
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaylistRequest;
use Auth;

class PlaylistController extends Controller
{
    public function page()
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

    public function update(PlaylistRequest $request)
    {
        $user = Auth::user();
        $initial = $request->input('videos')[0];
        if ($initial['title'] == null || $initial['id'] == null) {
            $user->playlist()->delete();
            return redirect()->back();
        }

        $data = $request->all();

        $user->playlist()->updateOrCreate(['user_id' => $user->id], $data);

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChannelRequest;
use Auth;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function page()
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

    public function update(ChannelRequest $request)
    {
        $user = Auth::user();

        $data = $request->input();
        if ($data['color'] == '2c95d8') unset($data['color']);

        $user->fill($data);

        if ($request->hasFile('logo')) {
            $user->addMedia($request->file('logo'))->toMediaCollection('logo');
        }

        $user->save();

        return redirect()->back()->with('status', 'Channel has been successfully updated.');
    }
}

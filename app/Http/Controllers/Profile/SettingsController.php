<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use Auth;
use Hash;

class SettingsController extends Controller
{
    public function page()
    {
        $user = Auth::user();
        $avatar = $user->getAvatar();

        $this->meta->prependTitle('Profile settings');
        return view('profile.settings', compact('user', 'avatar'));
    }

    public function update(SettingsRequest $request)
    {
        $user = Auth::user();

        $data = $request->only(['name', 'email', 'password']);

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

        return back()->with('status', trans('mimedio.profile.settings.updated'));
    }
}

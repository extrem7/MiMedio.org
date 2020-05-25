<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use File;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();

        $registered = User::where(['email' => $userSocial->getEmail()])->first();
        if (!$registered) $registered = User::where(['provider_id' => $userSocial->getId()])->first();

        if ($registered) {
            Auth::login($registered);
            return redirect('/');
        } else {
            $user = User::create([
                'name' => $userSocial->getName(),
                'email' => $userSocial->getEmail(),
                'provider_id' => $userSocial->getId(),
                'provider' => $provider,
            ]);

            if ($avatar = $userSocial->getAvatar()) {
                $user->addMediaFromUrl($avatar)->toMediaCollection('avatar');
            }

            Auth::login($user);
            return redirect()->route('home');
        }
    }
}

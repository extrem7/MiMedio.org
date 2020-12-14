<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;

class SocialController extends Controller
{
    public function redirectInstagram()
    {
        return Socialite::driver('instagrambasic')
            ->scopes('user_media')
            ->redirect();
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        /* @var $registered User */
        $registered = User::where(['email' => $userSocial->getEmail()])->first();
        if (!$registered) $registered = User::where(['provider_id' => $userSocial->getId()])->first();

        if ($registered) {
            Auth::login($registered, true);
            return redirect()->route('home');
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

    public function instagram()
    {
        $instagram = Socialite::driver('instagrambasic')->user();
        $shortToken = ((array)$instagram)['token']; // short living token

        $client = new Client();
        $response = $client->request('GET', 'https://graph.instagram.com/access_token', [
            'query' => [
                'grant_type' => 'ig_exchange_token',
                'client_secret' => '9ec6c37ba0055766ac9a3866cc30112d',
                'access_token' => $shortToken
            ]
        ]);

        $token = json_decode($response->getBody()->getContents(), true)['access_token']; //long living token

        $channel = \Auth::user()->channel;
        $channel->instagram()->updateOrCreate([
            'channel_id' => $channel->id,
        ], [
            'token' => $token,
            'expires_at' => Carbon::now()->addDays(60)->toDateTimeString()
        ]);

        return redirect()->route('settings.channel')->with('status', 'Instagram has been connected.');
    }
}

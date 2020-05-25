<?php

namespace App\Services;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class MessengerService
{
    public function getChats(bool $useFollowings = false)
    {
        $chats = $this->getContacts($useFollowings);

        $chats = $chats->map(function ($chat) {
            $chat->last = Message::whereIn('from', [$chat->id, auth()->id()])
                ->whereIn('to', [$chat->id, auth()->id()])
                ->orderBy('id', 'desc')
                ->first();
            return $chat;
        })->sortBy(function ($chat) {
            return $chat->last->id;
        })->reverse();
        return $chats;
    }

    public function getContacts(bool $useFollowings = false)
    {
        $receivers = User::with('avatarImage');
        $followings = [];

        if ($useFollowings) {
            $followings = \Auth::user()->followings;
            $receivers = $receivers->whereNotIn('id', $followings->pluck('id'));
        }

        $receivers = $receivers->where(function (Builder $query) {
            $query->whereHas('messages', function ($query) {
                $query->where('to', '=', auth()->id());
            })->orWhereHas('receivedMessages', function ($query) {
                $query->where('from', '=', auth()->id());
            });
        })->get();

        if ($useFollowings) {
            return collect()->merge($receivers)->merge($followings);
        }

        return $receivers;
    }
}

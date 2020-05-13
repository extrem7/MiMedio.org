<?php


namespace App\Services;


use App\Models\Message;
use App\Models\User;

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
        $followings = \Auth::user()->followings;

        $receivers = User::with('avatarImage')
            ->whereHas('messages', function ($query) {
                $query->where('to', '=', auth()->id());
            })
            ->orWhereHas('receivedMessages', function ($query) {
                $query->where('from', '=', auth()->id());
            });

        if ($useFollowings) {
            $receivers = $receivers->whereNotIn('id', $followings->pluck('id'))->get();
            return collect()->merge($receivers)->merge($followings);
        }

        return $receivers->get();
    }
}

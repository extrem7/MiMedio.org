<?php


namespace App\Services;


use App\Models\Message;
use App\Models\User;

class MessengerService
{
    public function getChats()
    {
        $chats = $this->getContacts();

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

    public function getContacts()
    {
        $followings = \Auth::user()->followings;

        $receivers = User::whereHas('messages', function ($query) {
            $query->where('to', '=', auth()->id());
        })->whereNotIn('id', $followings->pluck('id'))->get();

        return $receivers->merge($followings);
    }
}

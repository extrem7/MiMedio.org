<?php


namespace App\Services;


use App\Models\Polls\Poll;
use App\Models\User;
use Auth;

class PollsService
{
    public function sharePoll(User $user)
    {
        $poll = $user->ownPoll;

        if ($poll !== null) {
            $poll->voted = Auth::getUser()->hasVoted($poll->id);

            $answers = $this->getAnswers($poll);
            share(compact('poll', 'answers'));

            if (Auth::check()) {
                share([
                    'logged_in' => true,
                    'voted' => Auth::getUser()->hasVoted($poll->id)
                ]);
            }
        }
    }

    public function getAnswers(Poll $poll)
    {
        $total = $poll->votes->count();
        $results = $poll->results()->grab();
        return collect($results)->map(function ($result) use ($total) {
            return (object)[
                'voted' => Auth::check() && Auth::user()->options->contains('id', $result['option']->id),
                'votes' => $result['votes'],
                'percent' => $total === 0 ? 0 : ($result['votes'] / $total) * 100,
                'name' => $result['option']->name
            ];
        });
    }
}

<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PollRequest;
use App\Services\PollsService;
use Auth;
use Illuminate\Http\Request;
use App\Models\Polls\Poll;

class PollController extends Controller
{
    public function page()
    {
        $this->meta->prependTitle('My poll');

        $poll = Auth::getUser()->ownPoll;
        $answers = null;
        if ($poll !== null)
            $answers = $poll->options->pluck('name');

        return view('profile.poll', compact('poll', 'answers'));
    }

    public function store(PollRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $poll = $user->ownPoll()->updateOrCreate(['user_id' => $user->id], [
            'question' => $data['question']
        ]);

        $answers = $data['answers'];
        if ($poll->options->isNotEmpty()) {
            $options = $poll->options->pluck('name');
            $answers = array_filter($answers, function ($answer) use ($options) {
                return !$options->contains($answer);
            });
        }

        if (!empty($answers)) {
            if ($poll->options->isNotEmpty()) {
                $poll->attach($answers);
            } else {
                $poll->addOptions($answers)
                    ->maxSelection()
                    ->generate();
            }
        }

        return redirect()->back();
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->ownPoll->delete();
        return redirect()->back();
    }

    public function vote(PollsService $pollsService, Poll $poll, Request $request)
    {
        $this->validate($request, [
            'option' => 'required|exists:larapoll_options,id'
        ]);

        $user = Auth::getUser();

        $option = $poll->options->first(function ($item) use ($request) {
            return $item->id == $request->get('option');
        });

        $user->poll($poll)->vote($option->id);
        $option->updateTotalVotes();

        return response()->json([
            'status' => 'ok',
            'answers' => $pollsService->getAnswers($poll)
        ]);
    }
}

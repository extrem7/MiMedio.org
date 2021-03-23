<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\PollRequest;
use App\Services\PollsService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Polls\Poll;
use Inani\Larapoll\Option;

class PollController extends Controller
{
    public function page(): View
    {
        $this->meta->prependTitle('My poll');

        $poll = \Auth::getUser()->ownPoll;
        $answers = null;
        if ($poll !== null) {
            $answers = $poll->options->pluck('name');
        }

        return view('profile.poll', compact('poll', 'answers'));
    }

    public function store(PollRequest $request): RedirectResponse
    {
        $user = \Auth::user();
        $data = $request->validated();

        /* @var $poll Poll */
        $poll = $user->ownPoll()->updateOrCreate(['user_id' => $user->id], [
            'question' => $data['question']
        ]);

        $answers = $data['answers'];
        if ($poll->options->isNotEmpty()) {
            $options = $poll->options->pluck('name');
            $answers = array_filter($answers, fn($answer) => !$options->contains($answer));
        }

        if (!empty($answers)) {
            if ($poll->options->isNotEmpty()) {
                $poll->attach($answers);
            } else {
                $poll->addOptions($answers)->maxSelection()->generate();
            }
        }

        return back();
    }

    public function destroy(): RedirectResponse
    {
        \Auth::user()->ownPoll->delete();
        return back();
    }

    public function vote(PollsService $pollsService, Poll $poll, Request $request): JsonResponse
    {
        $this->validate($request, [
            'option' => ['required', 'integer', 'exists:larapoll_options,id']
        ]);

        /* @var $option Option */
        $option = $poll->options->where('id', '=', $request->input('option'))->first();

        \Auth::user()->poll($poll)->vote($option->id);
        $option->updateTotalVotes();

        return response()->json([
            'status' => 'ok',
            'answers' => $pollsService->getAnswers($poll)
        ]);
    }
}

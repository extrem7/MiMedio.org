<?php


namespace App\Models\Polls;

use Inani\Larapoll\Poll as BasePoll;

class Poll extends BasePoll
{
    protected $fillable = ['user_id', 'question'];

    protected $with = ['options'];
}

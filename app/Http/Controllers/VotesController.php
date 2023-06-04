<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function voteQuestion(Question $question,int $vote)
    {
        if(auth()->user()->hasVoteForQuestion($question))
        {
            if((auth()->user()->hasQuestionUpVoted($question) && $vote !== 1) || auth()->user()->hasQuestionDownVoted($question) && $vote !== -1)
            {
                $question->updateVote($vote);
            }
        }
        else
        {
            $question->vote($vote);
        }
        return redirect()->back();
    }
}

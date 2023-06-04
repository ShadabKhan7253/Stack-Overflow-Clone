<?php

namespace App\Http\Controllers;

use App\Http\Requests\createAnswerRequest;
use App\Http\Requests\MarkAsBestRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function store(createAnswerRequest $request, Question $question) {
        $question->answers()->create([
            'body' => $request->body,
            'user_id' => auth()->id()
        ]);
        session()->flash('success','Answer added succesfully');
        return redirect($question->url);
    }

    public function edit(Question $question, Answer $answer) {
        $this->authorize('update', $answer);
        return view('answers._edit', compact([
            'question',
            'answer'
        ]));
    }

    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer) {
        $answer->update([
            'body' => $request->body
        ]);
        session()->flash('success','Answer updated succesfully');
        return redirect($question->url);
    }

    public function destroy(Question $question,Answer $answer) {
        if($this->authorize('delete',[$answer, $question])) {
            $answer->delete();

            session()->flash('success', 'Answer deleted successfully!');
            return redirect()->back();
        }
        abort(403);
    }

    public function markAsBest(MarkAsBestRequest $request, Question $question, Answer $answer)
    {
        $this->authorize('markAsBest',$question);
        if($answer->question->id !== $question->id) {
            abort(403);
        }
        $question->markAsBest($answer);
        return redirect()->back();
    }

}

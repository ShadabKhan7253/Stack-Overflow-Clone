<?php

namespace App\Http\Controllers;

use App\Http\Requests\createAnswerRequest;
use App\Models\Question;
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

}

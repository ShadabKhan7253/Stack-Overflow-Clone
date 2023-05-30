<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function index() {
        $questions = Question::with('owner')->latest()->paginate(10);
        return view('questions.index',compact('questions'));
    }
}

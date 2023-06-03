<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = [];
    public static function boot() {
        parent::boot();
        static::created(function (Answer $answer) {
            $answer->question->increment('answers_count');
        });
        static::deleted(function (Answer $answer) {
            $answer->question->decrement('answers_count');
        });
    }


    public function getBestAnswerStyleAttribute(Question $question) {
        return $this->id === $question->best_answer_id ? 'text-success' : 'text-dark';
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function author() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }
}

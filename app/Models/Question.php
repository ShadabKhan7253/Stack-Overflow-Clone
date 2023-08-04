<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use tidy;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function setTitleAttribute(string $title) {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    public function owner() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function favorites() {
        return $this->belongsToMany(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function votes() {
        return $this->morphToMany(User::class,'vote')->withTimestamps();
    }

    public function getUrlAttribute() {
        return "/questions/$this->slug";
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getAnswerStylesAttribute() {
        if($this->answers_count > 0) {
            if($this->best_answer_id) {
                return 'has-best-answer';
            }
            return 'answered';
        }
        return 'unanswered';
    }

    public function markAsBest(Answer $answer) {
        $this->update(['best_answer_id' => $answer->id]);
    }

    // public function isBestAnswer(Answer $answer) {
    //     return $this->best_answer_id === $answer->id;
    // }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites()->count();
    }

    public function getIsFavoriteAttribute()
    {
        return $this->favorites()->where('user_id',auth()->id())->count() > 0;
    }

    public function vote(int $vote)
    {
        $this->votes()->attach(auth()->id(),['vote'=>$vote]);
        if($vote < 0)
        {
            $this->decrement('votes_count');
        }
        else
        {
            $this->increment('votes_count');
        }
    }

    public function updateVote(int $vote)
    {
        $this->votes()->updateExistingPivot(auth()->id(),['vote'=>$vote]);
        if($vote < 0)
        {
            $this->decrement('votes_count',2);
        }
        else
        {
            $this->increment('votes_count',2);
        }
    }
}

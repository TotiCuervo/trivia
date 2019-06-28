<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['question_id', 'title', 'correct', 'round_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function round()
    {
        return $this->belongsTo(Round::class);
    }
}

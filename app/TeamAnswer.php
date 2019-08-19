<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamAnswer extends Model
{
    public $fillable = ['team_id', 'answer', 'correct', 'points', 'question_id', 'matchIndex'];

    public function team() {
        return $this->belongsTo(Team::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'user_id', 'description', 'company', 'bodyColor', 'headClass', 'gameCode'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function gameOrder()
    {
        return $this->hasOne(GameOrder::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }

    public function questions()
    {
        return $this->hasManyThrough(Question::class, Round::class);
    }

    public function answers()
    {
        return $this->hasManyThrough(Answer::class, Round::class);
    }

    public function gameCodes()
    {
        return $this->hasMany(GameCode::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'type', 'round_id', 'order_number'];

    public function round()
    {
        return $this->belongsTo(Round::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'type', 'round_id'];

    public function round()
    {
        return $this->belongsTo(Round::class);
    }
}

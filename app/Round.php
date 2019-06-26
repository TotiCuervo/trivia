<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = ['game_id', 'order_number', 'title', 'time', 'round_type'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameCode extends Model
{
    protected $fillable = ['code', 'expirationTime', 'game_id'];

    public function game() {
        return $this->belongsTo(Game::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameOrder extends Model
{
    protected $fillable = ['order_number', 'type', 'type_id'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

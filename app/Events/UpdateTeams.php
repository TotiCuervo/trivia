<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Team;
use Illuminate\Support\Facades\Log;


class UpdateTeams implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $teams;
    public $gameCode;

    public function __construct($teams, $gameCode)
    {
        $this->teams = $teams;
        $this->gameCode = $gameCode;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('game.'.$this->gameCode);
    }

    public function broadcastWith()
    {
        return ["teams" => Team::where('gameCode', $this->gameCode)->orderBy('points', 'desc')->get()];
    }
}

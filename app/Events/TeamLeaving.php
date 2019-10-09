<?php

namespace App\Events;

use App\Team;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Support\Facades\Log;

class TeamLeaving implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
//        Log::error('made it here');
        return new PresenceChannel('game.'.$this->team->gameCode);
    }

    public function broadcastWith()
    {
        return ["team" => $this->team];
    }
}

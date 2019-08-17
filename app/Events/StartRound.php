<?php

namespace App\Events;

use App\Round;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use Illuminate\Support\Facades\Log;


class StartRound implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $roundPosition;

    public $gameCode;

    public function __construct($gameCode, $roundPosition)
    {
        $this->gameCode = $gameCode;
        $this->roundPosition = $roundPosition;
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
        return ["roundPosition" => $this->roundPosition];
    }
}

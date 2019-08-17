<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RevealAnswer implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $gameCode;
    public $roundPosition;
    public $questionPosition;

    public function __construct($gameCode, $roundPosition, $questionPosition)
    {
        $this->gameCode = $gameCode;
        $this->roundPosition = $roundPosition;
        $this->questionPosition = $questionPosition;
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
        return ["roundPosition" => $this->roundPosition, 'questionPosition' => $this->questionPosition];
}

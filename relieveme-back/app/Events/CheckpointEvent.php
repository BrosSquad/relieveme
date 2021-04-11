<?php

namespace App\Events;

use App\Models\Checkpoint;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CheckpointEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private Checkpoint $checkpoint, private string $action)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('checkpoints');
    }

    public function broadcastWith()
    {
        return ['type' => $this->action, 'data' => $this->checkpoint];
    }

    public function broadcastAs()
    {
        return 'checkpoint-event';
    }
}

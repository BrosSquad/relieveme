<?php

namespace App\Events;

use App\Models\Hazard;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class HazardEvent implements ShouldQueue, ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private Hazard $hazard, private string $action)
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('hazard.' . $this->hazard->id);
    }


    public function broadcastWith()
    {
        return ['type' => $this->action, 'data' => $this->hazard];
    }


    public function broadcastAs()
    {
        return 'hazard-event';
    }
}

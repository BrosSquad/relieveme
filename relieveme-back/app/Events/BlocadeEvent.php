<?php

namespace App\Events;

use App\Models\Blocade;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BlocadeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private $hazardId, private Blocade $blocade, private string $action)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('blocades.' . $this->hazardId);
    }

    public function broadcastWith()
    {
        return ['type' => $this->action, 'data' => $this->blocade];
    }


    public function broadcastAs()
    {
        return 'blocade-event';
    }
}

<?php

namespace App\Events;

use App\Models\Hazard;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewHazardHappened
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Hazard $hazard;

    /**
     * Create a new event instance.
     *
     * @param Hazard $hazard
     * @return void
     */
    public function __construct(Hazard $hazard)
    {
        //
        $this->hazard = $hazard;
    }
}

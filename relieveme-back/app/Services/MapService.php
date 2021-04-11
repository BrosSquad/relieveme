<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blocade;
use App\Models\Checkpoint;
use App\Models\Hazard;
use App\Models\Transport;
use Exception;

class MapService
{
    /**
     * Returns map data.
     *
     * @param int $hazard_id
     *
     * @return array
     *
     * @throws Exception
     */
    public function getMapData(int $hazard_id): array
    {
        $hazard = Hazard::whereId($hazard_id)->firstOrFail();
        $transports = Transport::all();
        $checkpoints = Checkpoint::with('helps')->get();
        $blocades = Blocade::whereHazardId($hazard_id)->get();

        $data = [
            'hazard' => $hazard,
            'transports' => $transports,
            'checkpoints' => $checkpoints,
            'blocades' => $blocades
        ];

        return $data;
    }
}

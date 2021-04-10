<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Blocade;
use App\Models\Checkpoint;
use App\Models\Hazard;
use App\Models\Transport;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

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
        $key = "hazard-{$hazard_id}-map-data";

        $cached = $this->getCachedData($key);

        if ($cached !== null) {
            return $cached;
        }

        $hazard = Hazard::whereId($hazard_id)->firstOrFail();
        $transports = Transport::query();
        $checkpoints = Checkpoint::query();
        $blocades = Blocade::whereHazardId($hazard_id)->firstOrFail();

        $data = [
            'hazard' => $hazard,
            'transports' => $transports,
            'checkpoints' => $checkpoints,
            'blocades' => $blocades
        ];

        if (!cache()->put($key, json_encode($data), Carbon::now()->addMinutes(30))) {
            Log::error('Error while inserting in redis.');
        }

        return $data;
    }

    /**
     * Returns cached data from Redis if it exists, or null.
     *
     * @throws Exception
     */
    private function getCachedData(string $key): ?array
    {
        $cachedData = cache()->get($key);

        return $cachedData !== null
            ? json_decode($cachedData, true)
            : null;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Blocade;
use App\Models\Checkpoint;
use App\Models\Hazard;
use App\Models\Transport;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MapController extends Controller
{
    /**
     * @param int $hazard_id
     *
     * @return JsonResponse
     */
    public function search(int $hazard_id): JsonResponse
    {
        $hazard = Hazard::whereId($hazard_id)->firstOrFail();
        $hazard->location->geog
        $transports = Transport::query();
        $checkpoints = Checkpoint::query();
        $blocades = Blocade::whereHazardId($hazard_id)->firstOrFail();
        $response = [
            'hazard' => $hazard,
            'transports' => $transports,
            'checkpoints' => $checkpoints,
            'blocades' => $blocades
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}

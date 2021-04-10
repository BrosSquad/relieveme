<?php

namespace App\Http\Controllers;

use App\Services\MapService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MapController extends Controller
{
    /**
     * MapController constructor.
     *
     * @param MapService $mapService
     */
    public function __construct(private MapService $mapService) {}

    /**
     * Returns map data
     *
     * @param int $hazard_id
     *
     * @return JsonResponse
     */
    public function search(int $hazard_id): JsonResponse
    {
        try {
            return response()->json(
                $this->mapService->getMapData($hazard_id),
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $exception) {
            \Log::error($exception->getMessage());
            $model = explode('\\', $exception->getModel())[2];
            return \response()->json([
                'message' => "{$model} not found."
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return \response()->json([
                'message' => $exception->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

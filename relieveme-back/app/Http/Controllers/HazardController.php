<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHazardRequest;
use App\Services\HazardService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HazardController extends Controller
{
    public function __construct(private HazardService $hazardService)
    {
    }

    public function getAll(Request $request): LengthAwarePaginator
    {
        return $this->hazardService->getAll($request->get('perPage', 10), $request->get('page', 1));
    }

    public function get($id): JsonResponse
    {
        return response()->json($this->hazardService->get($id));
    }

    public function create(CreateHazardRequest $request): JsonResponse
    {
        return response()->json($this->hazardService->create($request->validated()), 201);
    }

    public function delete($id): JsonResponse
    {
        $this->hazardService->delete($id);
        return response()->json([], 204);
    }
}

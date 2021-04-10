<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkpoints\CreateCheckpointRequest;
use App\Services\CheckpointService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CheckpointsController extends Controller
{
    /**
     * CheckpointsController constructor.
     *
     * @param CheckpointService $checkpointService
     */
    public function __construct(private CheckpointService $checkpointService) {}

    /**
     * Get all checkpoints.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->checkpointService->getCheckpoints()
        ], Response::HTTP_OK);
    }

    /**
     * Get specific checkpoint.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return \response()->json([$this->checkpointService->getCheckpoint($id)]);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
               'message' => 'Checkpoint not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Server error, please try again.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Creates a checkpoint.
     *
     * @param CreateCheckpointRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateCheckpointRequest $request): JsonResponse
    {
        try {
            return \response()->json(
                $this->checkpointService->createCheckpoint($request->validated()),
                Response::HTTP_CREATED
            );
        } catch (QueryException $exception) {
            return \response()->json([
                'message' => 'Failed to insert in database.',
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Server error, please try again',
            ]);
        }
    }

    /**
     * Delete a specific checkpoint.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->checkpointService->deleteCheckpoint($id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Checkpoint not found.'
            ], Response::HTTP_NOT_FOUND);
        }
        catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Server error, please try again',
            ]);
        }
    }
}

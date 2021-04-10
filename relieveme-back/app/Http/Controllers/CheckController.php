<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Checks\CheckInRequest;
use App\Http\Requests\Checks\CheckOutRequest;
use App\Services\CheckService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CheckController extends Controller
{
    public function __construct(private CheckService $checkService)
    {
    }

    public function checkIn(CheckInRequest $request): JsonResponse
    {
        $data = $request->validated();

        $status = $data['status'];
        $userIdentifier = $data['user_identifier'];
        $checkpointId = $data['checkpoint_id'];

        try {
            $checkOrFalse = $this->checkService->create($status, $checkpointId, $userIdentifier);

            if ($checkOrFalse === false) {
                return response()->json(
                    [
                        'message' => 'The user is already checked into this checkpoint.'
                    ],
                    Response::HTTP_ALREADY_REPORTED
                );
            }

            return response()->json($checkOrFalse, Response::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'The requested resource could not be found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    public function checkOut(CheckOutRequest $request): JsonResponse
    {
        $data = $request->validated();

        $userIdentifier = $data['user_identifier'];
        $checkpointId = $data['checkpoint_id'];

        try {
            $this->checkService->checkOut($checkpointId, $userIdentifier);

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'message' => 'The requested resource could not be found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}

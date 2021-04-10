<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transport\CreateTransportRequest;
use App\Http\Requests\Transport\UpdateTransportRequest;
use App\Services\TransportService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TransportController extends Controller
{
    public function __construct(private TransportService $transportService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            $this->transportService->getAll(),
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateTransportRequest $request
     * @return JsonResponse
     */
    public function store(CreateTransportRequest $request): JsonResponse
    {
        $data = $request->validated();

        return response()->json(
            $this->transportService->create($data),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse`
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = $this->transportService->get($id);

            return response()->json(
                $data,
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'error' => 'The requested resource could not be found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTransportRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateTransportRequest $request, int $id): JsonResponse
    {
        try {
            $data = $request->validated();

            return response()->json(
                [
                    'updated' => $this->transportService->update($id, $data),
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'error' => 'The requested resource could not be found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->transportService->delete($id);

            return response()->json(
                null,
                Response::HTTP_NO_CONTENT
            );
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'error' => 'The requested resource could not be found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}

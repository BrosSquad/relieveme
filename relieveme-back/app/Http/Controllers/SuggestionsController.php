<?php

namespace App\Http\Controllers;

use App\Http\Requests\Suggestions\CreateSuggestionRequest;
use App\Http\Requests\Suggestions\UpdateSuggestionRequest;
use App\Services\SuggestionsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SuggestionsController extends Controller
{
    public function __construct(private SuggestionsService $suggestionsService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = $this->suggestionsService->getAll();

        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSuggestionRequest $request
     *
     * @return JsonResponse
     */
    public function store(CreateSuggestionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $name = $data['name'];
        $hazardId = intval($data['hazard_id']);

        return response()
            ->json(
                $this->suggestionsService->create($name, $hazardId),
                Response::HTTP_CREATED
            );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $data = $this->suggestionsService->get($id);

            return response()->json($data, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(
                [
                    'error' => 'The requested resource could not be found.'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(UpdateSuggestionRequest $request, mixed $id): JsonResponse
    {
        $data = $request->validated();

        $name = $data['name'];
        $id = intval($id);

        try {
            return response()
                ->json(
                    [
                        'updated' => $this->suggestionsService->update($id, $name)
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
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->suggestionsService->delete($id);

            return response()->json(null, Response::HTTP_NO_CONTENT);
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

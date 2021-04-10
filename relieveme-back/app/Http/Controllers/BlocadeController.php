<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Blocades\CreateBlocadeRequest;
use App\Services\BlocadeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class BlocadeController extends Controller
{
    /**
     * BlocadeController constructor.
     *
     * @param BlocadeService $blocadeService
     */
    public function __construct(private BlocadeService $blocadeService) {}

    /**
     * Returns a list of Blocades.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->blocadeService->getBlocades()
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Blocades\CreateBlocadeRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBlocadeRequest $request): JsonResponse
    {
       try {
           return \response()->json(
               $this->blocadeService->createBlocade($request->validated()
               ),
               Response::HTTP_CREATED
           );
       } catch (\Exception $exception) {
           Log::error($exception->getMessage());
           return \response()->json([
               'message' => $exception->getMessage()
           ]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            return \response()->json(
                $this->blocadeService->getBlocade($id),
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Blocade not found.'
            ], Response::HTTP_NOT_FOUND);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Server error, please try again.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->blocadeService->deleteBlocade($id);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return \response()->json([
                'message' => 'Blocade not found.'
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

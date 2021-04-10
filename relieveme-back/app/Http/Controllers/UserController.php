<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function create(CreateUserRequest $request): JsonResponse
    {
        return new JsonResponse(
            [
                'token' => $this->userService->createUser($request->validated())->identifier,
            ],
            201
        );
    }
}

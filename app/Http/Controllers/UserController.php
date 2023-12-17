<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;
use function App\Helpers\successResponse;

class UserController extends Controller
{
    public function __construct(private readonly UserService $service)
    {
    }

    /**
     * @return JsonResponse
     */
    public function info(): JsonResponse
    {
        return successResponse($this->service->info());
    }

    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();
    }
}

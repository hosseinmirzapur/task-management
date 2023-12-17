<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Services\UserService;
use Illuminate\Http\JsonResponse;

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

    /**
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        return successResponse($this->service->update($data['username']));
    }

    /**
     * @param ChangePassRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function changePass(ChangePassRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->changePass($data['old'], $data['new']);
        return successResponse(null, 'password updated successfully');
    }
}

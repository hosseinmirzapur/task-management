<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\JsonResponse;
use function App\Helpers\successResponse;

class AuthController extends Controller
{

    public function __construct(private readonly AuthService $service)
    {
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $res = $this->service->login($data['username'], $data['password']);
        return successResponse($res, 'login was successful');
    }

    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     * @throws CustomException
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $res = $this->service->register($data['username'], $data['password']);
        return successResponse($res, 'user registered successfully');
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->service->logout();
        return successResponse(null, 'you were logged out successfully');
    }
}

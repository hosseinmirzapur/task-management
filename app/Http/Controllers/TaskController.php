<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(private readonly TaskService $service)
    {
    }

    /**
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        return successResponse($this->service->create($data));
    }

    /**
     * @param UpdateTaskRequest $request
     * @param $taskId
     * @return JsonResponse
     * @throws CustomException
     */
    public function update(UpdateTaskRequest $request, $taskId): JsonResponse
    {
        $data = $request->validated();
        return successResponse($this->service->update($data, $taskId));
    }

    /**
     * @param $taskId
     * @return JsonResponse
     * @throws CustomException
     */
    public function destroy($taskId): JsonResponse
    {
        $this->service->delete($taskId);
        return successResponse(null, 'task deleted successfully');
    }
}

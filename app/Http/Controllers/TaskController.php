<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\AssignUserToTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\OmitAssigneeRequest;
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

    /**
     * @param AssignUserToTaskRequest $request
     * @return JsonResponse
     */
    public function assignUser(AssignUserToTaskRequest $request): JsonResponse
    {
        $data = $request->validated();
        $this->service->assignUser($data['task_id'], $data['user_id']);
        return successResponse(null, 'tasks assigned to user successfully');
    }

    /**
     * @param OmitAssigneeRequest $request
     * @param $userId
     * @return JsonResponse
     * @throws CustomException
     */
    public function omitAssignee(OmitAssigneeRequest $request, $userId): JsonResponse
    {
        $data = $request->validated();
        $this->service->omitAssignee($data['task_id'], $userId);
        return successResponse(null, 'user unassigned successfully');
    }

    /**
     * @param $q
     * @return JsonResponse
     */
    public function search($q): JsonResponse
    {
        return successResponse($this->service->search($q));
    }
}

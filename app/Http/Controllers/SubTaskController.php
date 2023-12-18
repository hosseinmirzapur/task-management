<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\SubTaskRequest;
use App\Http\Requests\UpdateSubTaskRequest;
use App\Http\Services\SubTaskService;
use Illuminate\Http\JsonResponse;

class SubTaskController extends Controller
{
    public function __construct(private readonly SubTaskService $service)
    {
    }

    /**
     * @param SubTaskRequest $request
     * @return JsonResponse
     */
    public function store(SubTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        return successResponse(
            $this->service->create($request->validated())
        );
    }

    /**
     * @param UpdateSubTaskRequest $request
     * @param $subtaskId
     * @return JsonResponse
     * @throws CustomException
     */
    public function update(UpdateSubTaskRequest $request, $subtaskId): JsonResponse
    {
        return successResponse(
            $this->service->update($subtaskId, $request->validated())
        );
    }

    /**
     * @param $subtaskId
     * @return JsonResponse
     * @throws CustomException
     */
    public function destroy($subtaskId): JsonResponse
    {
        $this->service->delete($subtaskId);
        return successResponse(null, 'subtask deleted successfully');
    }
}

<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;

class TaskService
{
    /**
     * @param array $data
     * @return TaskResource
     */
    public function create(array $data): TaskResource
    {
        if (isset($data['document'])) {
            $data['document'] = saveFile($data['document'], '/documents');
        }
        $task = request()->user()->tasks()->create($data);
        return TaskResource::make($task);
    }

    /**
     * @param array $data
     * @param $taskId
     * @return TaskResource
     * @throws CustomException
     */
    public function update(array $data, $taskId): TaskResource
    {
        $task = Task::query()->find($taskId);
        if (!$task) {
            throw new CustomException('task not found', 404);
        }
        $task->update($data);
        return TaskResource::make($task);
    }

    /**
     * @param $taskId
     * @return void
     * @throws CustomException
     */
    public function delete($taskId): void
    {
        $task = Task::query()->find($taskId);
        if (!$task) {
            throw new CustomException('task not found', 404);
        }
        $task->delete();
    }

    /**
     * @param $taskId
     * @param $userId
     * @return bool
     */
    public function assignUser($taskId, $userId): bool
    {
        $task = Task::query()->find($taskId);
        return $task->assigned($userId);
    }

    /**
     * @param $taskId
     * @param $userId
     * @return bool
     * @throws CustomException
     */
    public function omitAssignee($taskId, $userId): bool
    {
        $task = Task::query()->find($taskId);
        $user = User::query()->find($userId);
        if (!$user) {
            throw new CustomException('user does not exists', 404);
        }
        return $task->canceledAssignation($userId, $taskId);
    }
}

<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Resources\SubTaskResource;
use App\Models\SubTask;
use App\Models\Task;

class SubTaskService
{
    /**
     * @param array $data
     * @return SubTaskResource
     */
    public function create(array $data): SubTaskResource
    {
        $task = Task::query()->find($data['task_id']);
        unset($data['task_id']);
        $subtask = $task->subtasks()->create($data);
        return SubTaskResource::make($subtask);
    }

    /**
     * @param $subtaskId
     * @param array $data
     * @return SubTaskResource
     * @throws CustomException
     */
    public function update($subtaskId, array $data): SubTaskResource
    {
        $subtask = SubTask::query()->find($subtaskId);
        if (!$subtask) {
            throw new CustomException('subtask not found', 404);
        }
        $subtask->update($data);
        return SubTaskResource::make($subtask);
    }

    /**
     * @param $subtaskId
     * @return void
     * @throws CustomException
     */
    public function delete($subtaskId): void
    {
        $subtask = SubTask::query()->find($subtaskId);
        if (!$subtask) {
            throw new CustomException('subtask not found', 404);
        }
        $subtask->delete();
    }
}

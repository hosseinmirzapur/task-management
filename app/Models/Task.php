<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    const PRIORITIES = ['HIGH', 'MEDIUM', 'LOW'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'tasks_users');
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    /**
     * @param $userId
     * @return bool
     */
    public function assigned($userId): bool
    {
        $n = $this->users()->sync([
            'user_id' => $userId,
        ]);

        return count($n) > 0;
    }

    /**
     * @param $userId
     * @param $taskId
     * @return bool
     */
    public function canceledAssignation($userId, $taskId): bool
    {
        $n = DB::table('tasks_users')
            ->where('user_id', $userId)
            ->where('task_id', $taskId)
            ->delete();
        return $n > 0;
    }
}

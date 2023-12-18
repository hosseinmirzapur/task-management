<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}

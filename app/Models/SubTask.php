<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{

    const SubTaskStatus = ['Pending', 'In Progress', 'Completed'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

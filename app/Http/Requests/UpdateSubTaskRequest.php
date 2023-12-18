<?php

namespace App\Http\Requests;

use App\Models\SubTask;
use Illuminate\Validation\Rule;

class UpdateSubTaskRequest extends SubTaskRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes',
            'description' => 'sometimes',
            'status' => ['sometimes', Rule::in(SubTask::STATUSES)],
            'deadline' => ['sometimes', 'date'],
        ];
    }
}

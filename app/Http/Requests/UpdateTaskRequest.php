<?php

namespace App\Http\Requests;

use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\ImageFile;

class UpdateTaskRequest extends CreateTaskRequest
{
    public function rules(): array
    {
        return [
            'title' => 'sometimes',
            'category' => 'sometimes',
            'description' => 'sometimes',
            'priority' => ['sometimes', Rule::in(Task::PRIORITIES)],
            'document' => ['sometimes', ImageFile::image()->max(1000 * 3)]
        ];
    }
}

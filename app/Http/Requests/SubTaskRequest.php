<?php

namespace App\Http\Requests;

use App\Models\SubTask;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'description' => 'sometimes',
            'status' => ['required', Rule::in(SubTask::STATUSES)],
            'deadline' => ['sometimes', 'date'],
            'task_id' => ['required', Rule::exists('tasks', 'id')]
        ];
    }
}

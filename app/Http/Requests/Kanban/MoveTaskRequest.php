<?php

namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class MoveTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'moved_task_id' => 'required|exists:tasks,id',
            'from_column_id' => 'required|exists:columns,id',
            'to_column_id' => 'required|exists:columns,id',

            'ordered_tasks' => 'required|array',
            'ordered_tasks.*.id' => 'required|exists:tasks,id',
            'ordered_tasks.*.position' => 'required|integer',
        ];
    }
}

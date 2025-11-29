<?php

namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class MoveColumnRequest extends FormRequest
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
            'moved_column_id' => 'required|exists:columns,id',

            'ordered_columns' => 'required|array',
            'ordered_columns.*.id' => 'required|exists:columns,id',
            'ordered_columns.*.position' => 'required|integer',
        ];
    }
}

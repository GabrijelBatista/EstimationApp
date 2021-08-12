<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'module_id' => 'numeric|required',
            'best_hours' => 'numeric|required|max:1000',
            'best_minutes' => 'numeric|required|max:59',
            'worst_hours' => 'numeric|required|max:1000',
            'worst_minutes' => 'numeric|required|max:59',
        ];
    }
}

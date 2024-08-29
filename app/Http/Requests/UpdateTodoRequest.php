<?php

namespace App\Http\Requests;

use App\Models\Todo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): \Illuminate\Auth\Access\Response
    {
        return Gate::authorize('update', $this->route('todo'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'status_id' => 'required|string|exists:status,id',
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required',
            'status_id.required' => 'Status is required',
            'status_id.exists' => 'Status does not exist',
        ];
    }
}

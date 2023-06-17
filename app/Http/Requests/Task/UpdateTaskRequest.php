<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'             => 'sometimes',
            'description'       => 'sometimes',
            'due_date'          => 'sometimes|date|date_format:Y-m-d|after:yesterday',
            'status'            => 'sometimes|in:completed,in-complete'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'msg' => $validator->errors()->first(),
            'data' => (object)[]
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}

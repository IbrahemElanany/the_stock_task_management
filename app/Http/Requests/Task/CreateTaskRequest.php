<?php

namespace App\Http\Requests\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CreateTaskRequest extends FormRequest
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
            'title'             => 'required',
            'description'       => 'required',
            'due_date'          => 'required|date|date_format:Y-m-d|after_or_equal:today',
            'status'            => 'in:completed,incomplete'
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

<?php

namespace App\Http\Requests\Collaboration;

use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CreateCollaborationRequest extends FormRequest
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
            'user_id'            => 'required|exists:users,id',
            'task_id'            => ['required',Rule::exists('tasks', 'id')->where('user_id', auth()->id())]
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

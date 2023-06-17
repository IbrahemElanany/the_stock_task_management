<?php

namespace App\Http\Requests\Attachment;

use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CreateAttachmentRequest extends FormRequest
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
            'attachment'            => 'required|image|mimes:jpg,jpeg,png,bmp,tiff,gif',
            'task_id'               => 'required|exists:tasks,id'
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

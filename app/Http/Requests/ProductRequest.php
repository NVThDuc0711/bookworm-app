<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            return [
                'id' => 'required|integer|exists:book,id',
            ];
        ];
    }
    public function messages(){
        return [
            'id.required' => 'Book id is required',
            'id.integer' => 'Book id must be an integer',
            'id.exists' => 'Book id does not exist',
        ];
    }

    public function failedValidation($validator)
    {
        $response = response()->json([
            'status' => 'error',
            'message' => $validator->errors()->first(),
        ], 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}

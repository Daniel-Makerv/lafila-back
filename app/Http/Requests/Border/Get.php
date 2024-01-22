<?php

namespace App\Http\Requests\Border;

use Illuminate\Foundation\Http\FormRequest;

class Get extends FormRequest
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
            'coordinate_one' => 'required',
            'coordinate_two' => 'required',
            'coordinate_tree' => 'required',
            'line' => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'coordinate_one' => 'coordinate_one',
            'coordinate_two' => 'coordinate_two',
            'coordinate_tree' => 'coordinate_tree',
            'line' => 'line',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'title.required' => 'A title is required',
            // 'body.required' => 'A message is required',
        ];
    }
}

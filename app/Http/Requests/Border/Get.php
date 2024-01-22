<?php

namespace App\Http\Requests\Border;

use App\Rules\CommaSeparatedNumbers;
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
     * @return \Illuminate\Http\JsonResponse

     */
    public function rules(): array
    {
        return [
            'coordinates' => ['required', new CommaSeparatedNumbers],
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
            'coordinates' => 'coordinates',
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

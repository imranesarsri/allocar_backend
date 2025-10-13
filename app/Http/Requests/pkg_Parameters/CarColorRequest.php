<?php

namespace App\Http\Requests\pkg_Parameters;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CarColorRequest extends FormRequest
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
            //
            'color_name' => [
            'required',
            'string',
            'max:30',
            Rule::unique('car_colors', 'color_name')
                ->ignore($this->route('car_color_id'), 'car_color_id'),
        ],
        'color_code' => [
            'nullable',
            'string',
            'regex:/^#[0-9A-Fa-f]{6}$/', 
        ],
        ];
    }

    /**
     * Customize the validation failure response.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),  // Return the errors directly
        ], 422));  // 422 is the HTTP status code for validation errors
    }

}

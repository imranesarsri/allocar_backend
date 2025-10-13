<?php

namespace App\Http\Requests\pkg_Subscriptions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PackageRequest extends FormRequest
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
        return  [
        'package_name' => [
            'required',
            'string',
            'max:50',
            Rule::unique('packages', 'package_name')
                ->ignore($this->route('package_id'), 'package_id'),
        ], 
            'price' => 'required|numeric|min:0',
            'max_car_limit' => 'required|integer|min:1',
            'description' => 'nullable|string'
        ];

    }
    
    /**
     * Customize the response returned when validation fails.
     *
     * This method overrides the default behavior to return a JSON response
     * with a custom error structure, including success status, message, and validation errors.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $validator->errors(),
        ], 422));
    }
}
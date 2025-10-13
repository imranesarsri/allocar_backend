<?php

namespace App\Http\Requests\pkg_Subscriptions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgencySubscriptionRequest extends FormRequest
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
            'agency_id' => 'required|exists:agencies,agency_id', 
            'package_id' => 'required|exists:packages,package_id', 
            'start_date' => 'required|date', 
            'end_date' => 'nullable|date|after:start_date', 
            'is_active' => 'required|boolean', 
            'current_car_count' => 'required|integer|min:0' 
        ];
    }

    /**
     *   Customization of the response in case of validation failure
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
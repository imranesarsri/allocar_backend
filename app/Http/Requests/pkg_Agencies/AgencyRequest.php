<?php

namespace App\Http\Requests\pkg_Agencies;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AgencyRequest extends FormRequest
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
            'agency_name' => [
            'required',
            'string',
            'max:100',
            Rule::unique('agencies', 'agency_name')
                ->ignore($this->route('agency_id'), 'agency_id'),
        ],
        'description' => [
            'nullable',
            'string',
        ],
        'address' => [
            'nullable',
            'string',
            'max:255',
        ],
        'city' => [
            'nullable',
            'string',
            'max:50',
        ],
        'phone_fix' => [
            'required',
            'string',
            'max:20',
        ],
        'phone_number_1' => [
            'required',
            'string',
            'max:20',
        ],
        'phone_number_2' => [
            'nullable',
            'string',
            'max:20',
        ],
        'email' => [
            'required',
            'email',
            Rule::unique('agencies', 'email')
                ->ignore($this->route('agency_id'), 'agency_id'),
        ],
        'website' => [
            'nullable',
            'url',
            'max:100',
        ],
        'logo_url' => [
            'nullable',
            'url',
            'max:255',
        ],
        'cover_image_url' => [
            'nullable',
            'url',
            'max:255',
        ],
        'facebook_url' => [
            'nullable',
            'url',
            'max:100',
        ],
        'instagram_url' => [
            'nullable',
            'url',
            'max:100',
        ],
        'other_social_media_url' => [
            'nullable',
            'url',
            'max:100',
        ],
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
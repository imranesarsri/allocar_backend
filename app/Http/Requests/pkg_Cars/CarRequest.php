<?php

namespace App\Http\Requests\pkg_Cars;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarRequest extends FormRequest
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
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'mileage' => 'required|integer|min:0',
            'transmission' => 'required|string|in:automatic,manual',
            'registration_number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('cars', 'registration_number')
                    ->ignore($this->route('car_id'), 'car_id'),
            ],
            'price' => 'required|numeric|min:0',
            'is_available' => 'required|boolean',
            'description' => 'nullable|string|max:1000',
            'features' => 'nullable|string|max:1000',
            'agency_id' => 'required|exists:agencies,agency_id',
            'car_brand_id' => 'required|exists:car_brands,car_brand_id',
            'car_category_id' => 'required|exists:car_categories,car_category_id',
            'car_model_id' => 'required|exists:car_models,car_model_id',
            'car_color_id' => 'required|exists:car_colors,car_color_id',
            'car_city_id' => 'required|exists:car_cities,car_city_id',
            'car_fuel_type_id' => 'required|exists:car_fuel_types,car_fuel_type_id',
            'is_discount' => 'boolean',
        
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                'required_if:is_discount,true',
                'lt:price' 
            ],
            
            'discount_end_date' => [
                'nullable',
                'date',
                'after:today',
                'required_if:is_discount,true'
            ]

        ];

    }

    public function messages()
{
    return [
        'discount_price.required_if' => 'Le prix de remise est obligatoire quand la remise est activée.',
        'discount_price.lt' => 'Le prix de remise doit être inférieur au prix normal.',
        'discount_end_date.required_if' => 'La date de fin de remise est obligatoire quand la remise est activée.',
        'discount_end_date.after' => 'La date de fin de remise doit être dans le futur.'
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

<?php

namespace App\Http\Requests\pkg_Blogs;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogCategoryRequest extends FormRequest
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
            'name' => [
            'required',
            'string',
            'max:100',
        ],
        'slug' => [
            'required',
            'string',
            'max:100',
            Rule::unique('blog_categories', 'slug')
                ->ignore($this->route('blog_category_id'), 'blog_category_id'),
        ],
        'description' => [
            'nullable',
            'string',
        ],
        'is_active' => [
            'boolean',
        ],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Erreur de validation',
            'errors' => $validator->errors(),
        ], 422));
    }
}

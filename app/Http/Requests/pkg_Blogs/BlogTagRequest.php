<?php

namespace App\Http\Requests\pkg_Blogs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BlogTagRequest extends FormRequest
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
            'max:50',
            Rule::unique('blog_tags', 'name')
                ->ignore($this->route('blog_tag_id'), 'blog_tag_id'),
        ],
        'slug' => [
            'required',
            'string',
            'max:50',
            Rule::unique('blog_tags', 'slug')
                ->ignore($this->route('blog_tag_id'), 'blog_tag_id'),
        ],
        'description' => [
            'nullable',
            'string',
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

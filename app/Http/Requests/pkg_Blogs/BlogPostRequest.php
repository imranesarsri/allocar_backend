<?php

namespace App\Http\Requests\pkg_Blogs;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BlogPostRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blog_posts', 'title')
                    ->ignore($this->route('blog_post_id'), 'blog_post_id'),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
            ],
            'content' => [
                'required',
                'string',
            ],
            'excerpt' => [
                'nullable',
                'string',
            ],
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],
            'meta_description' => [
                'nullable',
                'string',
                'max:255',
            ],
            'blog_author_id' => [
                'required',
                'exists:blog_authors,blog_author_id',
            ],
            'blog_category_id' => [
                'required',
                'exists:blog_categories,blog_category_id',
            ],
            'featured_image' => [
                'required',
                'url',
                'max:255',
            ],
            'is_published' => [
                'required',
                'boolean',
            ],
            'published_at' => [
                'nullable',
                'date',
            ],
            'tags' => [
                'nullable',
                'array',
            ],
            'tags.*' => [
                'exists:blog_tags,blog_tag_id',
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

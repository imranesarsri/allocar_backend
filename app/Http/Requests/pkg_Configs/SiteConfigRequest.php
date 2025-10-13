<?php

namespace App\Http\Requests\pkg_Configs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SiteConfigRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_logo' => 'nullable|url|max:255',
            'site_logo_dark' => 'nullable|url|max:255',
            'favicon_url' => 'nullable|url|max:255',
            'site_primary_color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'site_email' => 'nullable|email|max:100',
            'contact_form_email' => 'nullable|email|max:100',
            'support_email' => 'nullable|email|max:100',
            'contact_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'map_url' => 'nullable|url|max:255',
            'social_media_facebook' => 'nullable|url|max:100',
            'social_media_instagram' => 'nullable|url|max:100',
            'social_media_twitter' => 'nullable|url|max:100',
            'default_language' => 'required|in:en,ar,fr,es',
            'site_status' => 'required|in:live,maintenance,coming_soon'
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
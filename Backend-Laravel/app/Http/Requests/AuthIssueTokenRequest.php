<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthIssueTokenRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'abilities' => 'required|array',
            'abilities.*' => 'string',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Token name is required',
            'abilities.required' => 'Token abilities are required',
            'abilities.array' => 'Abilities must be an array',
        ];
    }
}

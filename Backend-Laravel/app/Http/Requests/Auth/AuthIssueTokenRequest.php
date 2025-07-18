<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AuthIssueTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:30', // Nom du token : obligatoire, entre 1 et 30 caractères
            'abilities' => 'required|array|min:1', // Abilities : tableau obligatoire contenant au moins un élément
            'abilities.*' => 'in:*,tasks:read,tasks:write,currentUser:read' // Chaque élément doit être dans la liste définie
        ];
    }
}

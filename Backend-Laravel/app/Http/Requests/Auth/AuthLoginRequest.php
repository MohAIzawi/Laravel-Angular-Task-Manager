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
        // L'autorisation est gérée par le middleware sanctum/ability dans le fichier de routes
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:1|max:30",
            "abilities" => "required|array|min:1",
            // Chaque élément doit être dans la liste définie: *, tasks:read, tasks:write, currentUser:read
            "abilities.*" => ["required", "string", "distinct", Rule::in(["*", "tasks:read", "tasks:write", "currentUser:read"])],
        ];
    }
}

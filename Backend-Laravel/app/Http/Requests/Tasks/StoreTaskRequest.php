<?php

namespace App\Http\Requests\Tasks;

/**
 * Form Request pour l'action `store` (création d'une tâche).
 * Hérite de `WriteTaskRequest` et ajoute des règles de validation.
 */
class StoreTaskRequest extends WriteTaskRequest
{
    /**
     * Définit les règles de validation pour la création d'une tâche.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            // Le titre est obligatoire et limité à 250 caractères
            "title" => "required|string|min:1|max:250",

            // La description est facultative mais limitée à 2000 caractères
            "description" => "nullable|string|max:2000",

            // La date d'échéance doit respecter le format ISO 8601
            "dueDate" => "nullable|date_format:Y-m-d\TH:i:sP",

            // L'utilisateur assigné doit exister dans la table users
            "assignedTo" => "nullable|integer|exists:users,id"
        ];
    }
}
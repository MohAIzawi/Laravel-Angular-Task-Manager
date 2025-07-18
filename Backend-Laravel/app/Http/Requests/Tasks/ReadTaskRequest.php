<?php

namespace App\Http\Requests\Tasks;

use App\Http\Requests\AbilityBasedRequest;

/**
 * Form Request pour les actions `index` et `show`.
 * Ces actions nécessitent une capacité de lecture (`tasks:read`).
 */
class ReadTaskRequest extends AbilityBasedRequest
{
    /**
     * Retourne les capacités nécessaires pour effectuer cette requête.
     *
     * @return array<string> Liste des capacités
     */
    public function getAbilities(): array
    {
        return ["*", "tasks:read", "tasks:write"]; // Lecture ou écriture autorisée
    }
}
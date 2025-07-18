<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbilityBasedRequest extends FormRequest
{
    /**
     * List of all abilities authorized to perform the action.
     *
     * @return array<string>
     */
    public abstract function getAbilities(): array;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user) {
            $abilities = $this->getAbilities();
            foreach ($abilities as $ability) {
                if ($this->user()->tokenCan($ability)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}


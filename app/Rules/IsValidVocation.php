<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsValidVocation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $vocation = config('tibia.vocations')[$value];

        if (!isset($vocation) || !$vocation['createable']) {
            $fail("The vocation selected is not valid.");
        }
    }
}

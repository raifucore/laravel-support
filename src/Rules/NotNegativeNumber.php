<?php

namespace RaifuCore\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotNegativeNumber implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (floatval($value) < 0) {
            $fail(__('raifucore::validation.notNegativeNumber'));
        }
    }
}

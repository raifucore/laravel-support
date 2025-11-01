<?php

namespace RaifuCore\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Telegram implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('^[a-zA-Z][a-zA-Z0-9_]{4,31}$', $value)) {
            $fail(__('raifucore::validation.telegram'));
        }
    }
}

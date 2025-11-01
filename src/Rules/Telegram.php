<?php

namespace RaifuCore\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Telegram implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[a-z][a-z0-9_]{4,31}$/i', $value)) {
            $fail(__('raifucore::validation.telegram'));
        }
    }
}

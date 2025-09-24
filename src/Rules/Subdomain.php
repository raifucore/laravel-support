<?php

namespace RaifuCore\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Subdomain implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?$', $value)) {
            $fail(__('raifucore::validation.subdomain'));
        }
    }
}

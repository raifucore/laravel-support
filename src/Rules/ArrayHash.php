<?php

namespace RaifuCore\Support\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use RaifuCore\Support\Helpers\StringHelper;

class ArrayHash implements ValidationRule
{
    private string $arrayHash;

    public function __construct(array $array)
    {
        $this->arrayHash = StringHelper::arrayHash($array);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== $this->arrayHash) {
            $fail(__('validation.arrayHash'));
        }
    }
}

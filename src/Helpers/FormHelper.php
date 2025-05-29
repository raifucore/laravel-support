<?php

namespace RaifuCore\Support\Helpers;

class FormHelper
{
    public static function isChecked(mixed $value = null): bool
    {
        if (is_bool($value)) {
            return $value;
        }

        if ($value === 0) {
            return false;
        }

        if ($value === 1) {
            return true;
        }

        if (is_string($value)) {
            switch (strtolower($value)) {
                case "true":
                case "on":
                case "1":
                    return true;

                case "false":
                case "off":
                case "0":
                    return false;
            }
        }
        return false;
    }
}

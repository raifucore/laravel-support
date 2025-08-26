<?php

namespace RaifuCore\Support\Helpers;

class StringHelper
{
    public static function clean(string|null $string): string|null
    {
        return self::addslashes(self::strip($string));
    }

    public static function strip(string|null $string): string|null
    {
        return !is_null($string) ? strip_tags($string) : null;
    }

    public static function addslashes(string|null $string): string|null
    {
        return !is_null($string) ? addslashes($string) : null;
    }

    public static function keepOnlyNumbers(string|null $string): string|null
    {
        return !is_null($string) ? preg_replace('[\D]', '', $string) : null;
    }

    public static function keepOnlyLetters(string|null $string): string|null
    {
        return !is_null($string) ? preg_replace('~[^\p{L}]~u', '', $string) : null;
    }

    public static function arrayHash(array $array): string
    {
        $array[] = config('app.key');

        return hash('sha512', implode('~!~^~#~&~$~', $array));
    }

    public static function getPlural(int $count, string $one, string $few = null, string $many = null): string
    {
        $count = intval(abs($count));
        if ($count % 100 == 1 || ($count % 100 > 20) && ($count % 10 == 1)) {
            return $one;
        }
        if ($count % 100 == 2 || ($count % 100 > 20) && ($count % 10 == 2)) {
            return $few ?? $one;
        }
        if ($count % 100 == 3 || ($count % 100 > 20) && ($count % 10 == 3)) {
            return $few ?? $one;
        }
        if ($count % 100 == 4 || ($count % 100 > 20) && ($count % 10 == 4)) {
            return $few ?? $one;
        }

        return $many ?? $one;
    }
}

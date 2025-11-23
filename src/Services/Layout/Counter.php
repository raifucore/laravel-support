<?php

namespace RaifuCore\Support\Services\Layout;

use Illuminate\Support\Arr;

class Counter
{
    private static array $data = [];

    public function set(string $label, int $value): self
    {
        $existing = Arr::get(self::$data, $label);

        // Нельзя перезаписать массив скаляром
        if (is_array($existing)) {
            throw new \LogicException("Cannot overwrite array at key [$label]");
        }

        Arr::set(self::$data, $label, $value);

        self::normalizeToArray($label);

        return $this;
    }

    public function get(string $label): int|null
    {
        $value = Arr::get(self::$data, $label);

        if ($value === null) {
            return null;
        }

        if (is_array($value)) {
            return self::sum($value);
        }

        return $value;
    }

    public function total(): int
    {
        if (empty(self::$data)) {
            return 0;
        }

        return self::sum(self::$data);
    }
    public function dump(): array
    {
        return self::$data;
    }

    private static function sum(array $items): int
    {
        $total = 0;

        foreach ($items as $v) {
            if (is_array($v)) {
                $total += self::sum($v);
            } else {
                $total += $v;
            }
        }

        return $total;
    }

    private static function normalizeToArray(string $label): void
    {
        $parts = explode('.', $label);
        array_pop($parts);

        while (!empty($parts)) {
            $path = implode('.', $parts);
            $value = Arr::get(self::$data, $path);

            if (!is_array($value)) {
                Arr::set(self::$data, $path, []);
            }

            array_pop($parts);
        }
    }
}

<?php

namespace RaifuCore\Support\Services;

use DateTimeImmutable;
use DateTimeInterface;
use InvalidArgumentException;
use RaifuCore\Support\Enums\VariableTypeEnum;

class VariableValueCaster
{
    public function toString(mixed $value, VariableTypeEnum $type): string
    {
        return match ($type) {
            VariableTypeEnum::BOOL => $value ? '1' : '0',

            VariableTypeEnum::STRING,
            VariableTypeEnum::TEXT,
            VariableTypeEnum::JSON,
            VariableTypeEnum::UUID,
            VariableTypeEnum::INT,
            VariableTypeEnum::FLOAT => (string) $value,

            VariableTypeEnum::ARRAY => json_encode($value, JSON_UNESCAPED_UNICODE),

            VariableTypeEnum::DATE => $this->formatDate($value, 'Y-m-d'),

            VariableTypeEnum::DATETIME,
            VariableTypeEnum::TIMESTAMP => $this->formatDate($value, 'Y-m-d H:i:s'),

            VariableTypeEnum::TIME => $this->formatDate($value, 'H:i:s'),
        };
    }

    public function fromString(string $value, VariableTypeEnum $type): mixed
    {
        return match ($type) {
            VariableTypeEnum::BOOL => in_array(strtolower($value), ['1', 'true', 'yes', 'on']),

            VariableTypeEnum::STRING,
            VariableTypeEnum::TEXT,
            VariableTypeEnum::JSON,
            VariableTypeEnum::UUID => $value,

            VariableTypeEnum::INT => (int) $value,

            VariableTypeEnum::FLOAT => (float) $value,

            VariableTypeEnum::ARRAY => json_decode($value, true),

            VariableTypeEnum::DATE,
            VariableTypeEnum::DATETIME,
            VariableTypeEnum::TIMESTAMP,
            VariableTypeEnum::TIME => new DateTimeImmutable($value),
        };
    }

    private function formatDate(mixed $value, string $format): string
    {
        if ($value instanceof DateTimeInterface) {
            return $value->format($format);
        }

        if (is_string($value)) {
            return (new DateTimeImmutable($value))->format($format);
        }

        throw new InvalidArgumentException('Value must be date string or DateTimeInterface');
    }
}
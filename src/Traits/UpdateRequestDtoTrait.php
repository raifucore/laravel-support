<?php

namespace RaifuCore\Support\Traits;

use BackedEnum;
use UnitEnum;

trait UpdateRequestDtoTrait
{
    protected array $modified = [];

    public function setModified(string|UnitEnum $field): static
    {
        $this->modified[] = $this->_normalize($field);

        return $this;
    }

    public function isModified(string|UnitEnum $field = null): bool
    {
        return $field
            ? in_array($this->_normalize($field), $this->modified)
            : count($this->modified) > 0;
    }

    private function _normalize(string|UnitEnum $field): string
    {
        return $field instanceof UnitEnum
            ? ($field instanceof BackedEnum ? $field->value : $field->name)
            : $field;
    }
}

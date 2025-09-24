<?php

namespace RaifuCore\Support\Models;

use RaifuCore\Support\Contracts\Arrayable;

class ModelField implements Arrayable
{
    protected string $field;
    protected mixed $oldValue;
    protected mixed $newValue;

    public function fromArray(array $data): static
    {
        return $this
            ->setField($data['field'])
            ->setOldValue($data['old'])
            ->setNewValue($data['new']);
    }

    public function toArray(): array
    {
        return [
            'field' => $this->getField(),
            'old' => $this->getOldValue(),
            'new' => $this->getNewValue()
        ];
    }

    public function getField(): string
    {
        return $this->field;
    }

    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    public function getOldValue(): mixed
    {
        return $this->oldValue;
    }

    public function setOldValue(mixed $oldValue): self
    {
        $this->oldValue = $oldValue;
        return $this;
    }

    public function getNewValue(): mixed
    {
        return $this->newValue;
    }

    public function setNewValue(mixed $newValue): self
    {
        $this->newValue = $newValue;
        return $this;
    }
}

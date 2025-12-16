<?php

namespace RaifuCore\Support\Services\Layout\Dto;

class MenuItemBadgeDto
{
    protected int|null $count = null;
    protected string|null $class = null;

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setCount(?int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'count' => $this->count,
            'class' => $this->class,
        ];
    }
}

<?php

namespace RaifuCore\Support\Services\Layout\Dto;

use Illuminate\Support\Collection;

class MenuItemDto
{
    protected string|null $name = null;
    protected string|null $href = null;
    protected string|null $target = null;
    protected string|null $icon = null;
    protected string|null $class = null;
    protected bool $isCurrent = false;
    protected bool $isAvailable = true;
    protected MenuItemBadgeDto|null $badge = null;
    protected Collection|null $items = null;

    public function __construct(protected string $label) {}

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getHref(): ?string
    {
        return $this->href;
    }

    public function getTarget(): ?string
    {
        return $this->target;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function isCurrent(): bool
    {
        return $this->isCurrent;
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function getBadge(): ?MenuItemBadgeDto
    {
        return $this->badge;
    }

    /**
     * @return Collection<MenuItemDto>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setHref(?string $href): self
    {
        $this->href = $href;

        return $this;
    }

    public function setTarget(?string $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function setClass(?string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function setIsCurrent(bool $isCurrent): self
    {
        $this->isCurrent = $isCurrent;

        return $this;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    public function setBadge(?MenuItemBadgeDto $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function addItem(MenuItemDto $item): self
    {
        if (is_null($this->items)) {
            $this->items = collect();
        }

        $this->items->add($item);

        return $this;
    }
}

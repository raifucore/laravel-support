<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\MenuItemDto;
use Illuminate\Support\Collection;

class Menu
{
    protected bool $isCollapsed = false;
    protected Collection $items;

    public function __construct(protected string $label)
    {
        $this->items = collect();
    }

    public function isCollapsed(): bool
    {
        return $this->isCollapsed;
    }

    /**
     * @return Collection<MenuItemDto>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function setIsCollapsed(bool $isCollapsed): self
    {
        $this->isCollapsed = $isCollapsed;

        return $this;
    }

    public function addItem(MenuItemDto $item): self
    {
        $this->items->add($item);

        return $this;
    }

    public function setCurrentItem(string|array $currentItemLabel, bool $erase = false): self
    {

        return $this;
    }
}

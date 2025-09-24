<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\MenuItemDto;
use Illuminate\Support\Collection;

class Menu
{
    protected bool $isCollapsed = false;
    protected string|null $currentModule = null;
    protected string|null $currentItem = null;
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect();
    }

    public function isCollapsed(): bool
    {
        return $this->isCollapsed;
    }

    public function getCurrentModule(): ?string
    {
        return $this->currentModule;
    }

    public function getCurrentItem(): ?string
    {
        return $this->currentItem;
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

    public function setCurrentModule(?string $currentModule): self
    {
        $this->currentModule = $currentModule;

        return $this;
    }

    public function setCurrentItem(?string $currentItem): self
    {
        $this->currentItem = $currentItem;

        return $this;
    }

    public function addItem(MenuItemDto $item): self
    {
        $this->items->add($item);

        return $this;
    }
}

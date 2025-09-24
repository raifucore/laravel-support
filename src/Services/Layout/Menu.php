<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\MenuItemDto;
use Illuminate\Support\Collection;

class Menu
{
    protected string|null $currentModule = null;
    protected string|null $currentItem = null;
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect();
    }

    /**
     * @return Collection<MenuItemDto>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(MenuItemDto $item): self
    {
        $this->items->add($item);

        return $this;
    }
}

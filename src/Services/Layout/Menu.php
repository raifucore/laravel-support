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

    public function setCurrentItem(string|array $itemLabel, bool $erase = false): self
    {
        $labels = is_array($itemLabel) ? $itemLabel : [$itemLabel];

        $apply = function (Collection $items) use (&$apply, $labels, $erase): void {
            foreach ($items as $item) {
                $isMatch = in_array($item->getLabel(), $labels, true);
                if ($isMatch) {
                    $item->setIsCurrent(true);
                } elseif ($erase) {
                    $item->setIsCurrent(false);
                }

                $children = $item->getItems();
                if ($children instanceof Collection && $children->isNotEmpty()) {
                    $apply($children);
                }
            }
        };

        $apply($this->items);

        return $this;
    }

    public function toArray(): array
    {
        return $this->items
            ->filter(fn (MenuItemDto $item) => $item->isAvailable())
            ->map(fn (MenuItemDto $item) => $item->toArray())
            ->values()
            ->toArray();
    }

    public function toJson(int $flags = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray(), $flags);
    }
}

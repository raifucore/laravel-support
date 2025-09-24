<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\BreadcrumbDto;
use Illuminate\Support\Collection;

class Breadcrumbs
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect();
    }

    public function isNotEmpty(): bool
    {
        return $this->items->isNotEmpty();
    }

    /**
     * @return Collection<BreadcrumbDto>
     */
    public function get(): Collection
    {
        return $this->items;
    }

    public function add(BreadcrumbDto $breadcrumbDto): self
    {
        $this->items->add($breadcrumbDto);
        return $this;
    }
}

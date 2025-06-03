<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\MetaDto;
use Illuminate\Support\Collection;

class Meta
{
    protected Collection $items;

    public function __construct()
    {
        $this->items = collect();
    }

    /**
     * @return Collection<MetaDto>
     */
    public function get(): Collection
    {
        return $this->items;
    }

    public function add(MetaDto $metaDto): self
    {
        $this->items->add($metaDto);
        return $this;
    }
}

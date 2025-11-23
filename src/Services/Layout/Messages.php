<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\MessageDto;
use Illuminate\Support\Collection;

class Messages
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
     * @return Collection<MessageDto>
     */
    public function get(): Collection
    {
        return $this->items;
    }

    public function add(MessageDto $messageDto): self
    {
        $this->items->add($messageDto);
        return $this;
    }
}

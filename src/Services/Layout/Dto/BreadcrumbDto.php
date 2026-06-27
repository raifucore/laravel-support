<?php

namespace RaifuCore\Support\Services\Layout\Dto;

class BreadcrumbDto
{
    public function __construct(
        protected string $label,
        protected ?string $url = null,
        protected bool|null $isHome = false
    ) {}

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function isHome(): bool
    {
        return (bool) $this->isHome;
    }
}

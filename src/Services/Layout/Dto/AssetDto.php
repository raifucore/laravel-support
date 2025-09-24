<?php

namespace RaifuCore\Support\Services\Layout\Dto;

class AssetDto
{
    public function __construct(protected string $path) {}

    public function getPath(): string
    {
        return $this->path;
    }
}

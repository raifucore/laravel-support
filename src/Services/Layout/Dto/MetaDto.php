<?php

namespace RaifuCore\Support\Services\Layout\Dto;

class MetaDto
{
    public function __construct(
        protected string $name,
        protected string $content,
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

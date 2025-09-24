<?php

namespace RaifuCore\Support\Services\Layout\Dto;

use RaifuCore\Support\Services\Layout\Enums\MessageLevelEnum;

class MessageDto
{
    public function __construct(
        protected string $message,
        protected MessageLevelEnum $level = MessageLevelEnum::INFO,
        protected bool $isDismissible = false,
        protected string|null $buttonText = null,
        protected string|null $buttonLink = null,
        protected string|null $buttonOnclick = null,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLevel(): MessageLevelEnum
    {
        return $this->level;
    }

    public function isDismissible(): bool
    {
        return $this->isDismissible;
    }

    public function getButtonText(): string|null
    {
        return $this->buttonText;
    }

    public function getButtonLink(): string|null
    {
        return $this->buttonLink;
    }

    public function getButtonOnclick(): string|null
    {
        return $this->buttonOnclick;
    }

    public function hasButton(): bool
    {
        return $this->buttonText && ($this->buttonLink || $this->buttonOnclick);
    }
}

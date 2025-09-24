<?php

namespace RaifuCore\Support\Services\Layout;

class Page
{
    protected string|null $title = null;

    protected string|null $header = null;

    protected string|null $keywords = null;

    protected string|null $description = null;

    protected bool $noIndex = false;

    public function getTitle(): string|null
    {
        return $this->title;
    }

    public function getHeader(): string|null
    {
        return $this->header;
    }

    public function getKeywords(): string|null
    {
        return $this->keywords;
    }

    public function getDescription(): string|null
    {
        return $this->description;
    }

    public function isNoIndex(): bool
    {
        return $this->noIndex;
    }

    public function setTitle(string|null $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setHeader(string|null $header): self
    {
        $this->header = $header;
        return $this;
    }

    public function setKeywords(string|null $keywords): self
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function setDescription(string|null $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setNoIndex(): self
    {
        $this->noIndex = true;
        return $this;
    }
}

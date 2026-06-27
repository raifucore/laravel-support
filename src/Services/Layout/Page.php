<?php

namespace RaifuCore\Support\Services\Layout;

class Page
{
    protected ?string $title = null;
    protected ?string $header = null;
    protected ?string $keywords = null;
    protected ?string $description = null;
    protected ?string $canonical = null;
    protected bool $noIndex = false;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getHeader(): ?string
    {
        return $this->header;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCanonical(): ?string
    {
        return $this->canonical;
    }

    public function isNoIndex(): bool
    {
        return $this->noIndex;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setHeader(?string $header): self
    {
        $this->header = $header;
        return $this;
    }

    public function setKeywords(?string $keywords): self
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setCanonical(?string $canonical): self
    {
        $this->canonical = $canonical;
        return $this;
    }

    public function setNoIndex(): self
    {
        $this->noIndex = true;
        return $this;
    }
}

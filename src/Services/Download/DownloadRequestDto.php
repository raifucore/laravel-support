<?php

namespace RaifuCore\Support\Services\Download;

class DownloadRequestDto
{
    public function __construct(
        protected string      $path,
        protected string|null $name = null,
        protected bool        $deleteAfterDownload = false,
    ) {}

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function isDeleteAfterDownload(): bool
    {
        return $this->deleteAfterDownload;
    }
}

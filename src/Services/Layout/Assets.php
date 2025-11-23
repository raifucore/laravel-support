<?php

namespace RaifuCore\Support\Services\Layout;

use RaifuCore\Support\Services\Layout\Dto\AssetDto;
use Illuminate\Support\Collection;

class Assets
{
    protected Collection $js;
    protected Collection $css;

    public function __construct()
    {
        $this->js = collect();
        $this->css = collect();
    }

    /**
     * @return Collection<AssetDto>
     */
    public function js(): Collection
    {
        return $this->js;
    }

    /**
     * @return Collection<AssetDto>
     */
    public function css(): Collection
    {
        return $this->css;
    }

    public function addJs(string $assetPath): self
    {
        $this->js->add(new AssetDto($assetPath));
        return $this;
    }

    public function addCss(string $assetPath): self
    {
        $this->css->add(new AssetDto($assetPath));
        return $this;
    }
}

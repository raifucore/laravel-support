<?php

namespace RaifuCore\Support\Contracts;

interface Arrayable extends \Illuminate\Contracts\Support\Arrayable
{
    public function fromArray(array $data): static;
}

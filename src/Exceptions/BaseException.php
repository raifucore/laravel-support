<?php

namespace RaifuCore\Support\Exceptions;

use Exception;

class BaseException extends Exception
{
    protected static array $data = [];

    public function getData(): array
    {
        return static::$data;
    }

    public function setData(array $data): void
    {
        static::$data = $data;
    }
}

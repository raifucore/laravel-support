<?php

namespace RaifuCore\Support\Exceptions;

use Exception;
use Throwable;

class BaseException extends Exception
{
    protected static array $data = [];

    public function __construct(?string $message = null, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getData(): array
    {
        return static::$data;
    }

    public function setData(array $data): void
    {
        static::$data = $data;
    }
}

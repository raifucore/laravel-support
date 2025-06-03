<?php

namespace RaifuCore\Support\Services\Layout\Enums;

enum MessageLevelEnum: string
{
    case INFO = 'INFO';
    case DANGER = 'DANGER';
    case WARNING = 'WARNING';
    case SUCCESS = 'SUCCESS';

    public function htmlAlertClass(): string
    {
        return match ($this) {
            self::INFO => 'alert-info',
            self::DANGER => 'alert-danger',
            self::WARNING => 'alert-warning',
            self::SUCCESS => 'alert-success',
        };
    }

    public function htmlBtnClass(): string
    {
        return match ($this) {
            self::INFO => 'btn-info',
            self::DANGER => 'btn-danger',
            self::WARNING => 'btn-warning',
            self::SUCCESS => 'btn-success',
        };
    }
}

<?php

namespace RaifuCore\Support\Listeners;

use RaifuCore\Support\Contracts\ListenerInterface;

abstract class BaseListener implements ListenerInterface
{
    public string $queue = 'listeners';
}

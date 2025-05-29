<?php

namespace RaifuCore\Support\Providers;

use Illuminate\Support\Facades\Context;
use Illuminate\Support\Str;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        Context::add('_rc_start_microtime', microtime(1));
        Context::add('_rc_trace_id', Str::uuid()->toString());
        Context::add('_rc_url', request()->url());
    }

    public function register(): void
    {

    }
}

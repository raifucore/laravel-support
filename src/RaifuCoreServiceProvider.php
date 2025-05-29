<?php

namespace RaifuCore\Support;

use Illuminate\Support\Facades\Context;
use Illuminate\Support\Str;

class RaifuCoreServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(): void
    {
        Context::add('_rc_start_microtime', microtime(1));
        Context::add('_rc_trace_id', Str::uuid()->toString());
        Context::add('_rc_url', request()->url());

        $this->_loadLang();
    }

    private function _loadLang(): void
    {
        $langPath = __DIR__ . '/../resources/lang';

        // Load
        $this->loadTranslationsFrom($langPath, 'raifucore');

        // Publish
        $this->publishes([
            $langPath => resource_path('lang/vendor/raifucore'),
        ], 'lang');
    }
}
